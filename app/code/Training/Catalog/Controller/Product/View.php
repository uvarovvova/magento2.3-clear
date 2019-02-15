<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Catalog\Controller\Product;

use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Controller\Product as ProductAction;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\Result\RedirectFactory;

/**
 * View a product on storefront. Needs to be accessible by POST because of the store switching.
 */
class View extends ProductAction implements HttpGetActionInterface, HttpPostActionInterface
{
	/**
	 * @var \Magento\Catalog\Helper\Product\View
	 */
	protected $viewHelper;

	/**
	 * @var \Magento\Framework\Controller\Result\ForwardFactory
	 */
	protected $resultForwardFactory;

	/**
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	protected $resultPageFactory;

	/**
	 * @var \Magento\Customer\Model\Session
	 */
	protected $customerSession;

	protected $resultRedirectFactory;

	/**
	 * View constructor.
	 * @param Context $context
	 * @param \Magento\Catalog\Helper\Product\View $viewHelper
	 * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
	 * @param PageFactory $resultPageFactory
	 * @param Session $customerSession
	 * @param RedirectFactory $resultRedirectFactory
	 */
	public function __construct(
		Context $context,
		\Magento\Catalog\Helper\Product\View $viewHelper,
		\Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
		PageFactory $resultPageFactory,
		Session $customerSession,
		RedirectFactory $resultRedirectFactory
	) {
		$this->viewHelper = $viewHelper;
		$this->resultForwardFactory = $resultForwardFactory;
		$this->resultPageFactory = $resultPageFactory;
		$this->customerSession = $customerSession;
		$this->resultRedirectFactory;
		parent::__construct($context);
	}

	/**
	 * Product view action
	 *
	 * @return \Magento\Framework\Controller\Result\Forward|\Magento\Framework\Controller\Result\Redirect
	 */
	public function execute()
	{
		if(!$this->customerSession->isLoggedIn()) {
			$redirect = $this->resultRedirectFactory->create();
			return $redirect->setPath('customer/account/create/');
		}

		// Get initial data from request
		$categoryId = (int) $this->getRequest()->getParam('category', false);
		$productId = (int) $this->getRequest()->getParam('id');
		$specifyOptions = $this->getRequest()->getParam('options');

		if ($this->getRequest()->isPost() && $this->getRequest()->getParam(self::PARAM_NAME_URL_ENCODED)) {
			$product = $this->_initProduct();

			if (!$product) {
				return $this->noProductRedirect();
			}

			if ($specifyOptions) {
				$notice = $product->getTypeInstance()->getSpecifyOptionMessage();
				$this->messageManager->addNoticeMessage($notice);
			}

			if ($this->getRequest()->isAjax()) {
				$this->getResponse()->representJson(
					$this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)->jsonEncode([
						'backUrl' => $this->_redirect->getRedirectUrl()
					])
				);
				return;
			}
			$resultRedirect = $this->resultRedirectFactory->create();
			$resultRedirect->setRefererOrBaseUrl();
			return $resultRedirect;
		}

		// Prepare helper and params
		$params = new \Magento\Framework\DataObject();
		$params->setCategoryId($categoryId);
		$params->setSpecifyOptions($specifyOptions);

		// Render page
		try {
			$page = $this->resultPageFactory->create();
			$this->viewHelper->prepareAndRender($page, $productId, $this, $params);
			return $page;
		} catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
			return $this->noProductRedirect();
		} catch (\Exception $e) {
			$this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
			$resultForward = $this->resultForwardFactory->create();
			$resultForward->forward('noroute');
			return $resultForward;
		}
	}
}
