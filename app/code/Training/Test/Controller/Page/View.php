<?php

namespace Training\Test\Controller\Page;

use Magento\Cms\Helper\Page;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Cms\Api\PageRepositoryInterface;

/**
 * Class View
 * @package Training\Test\Controller\Page
 */
class View extends \Magento\Cms\Controller\Index\Index
{
	/**
	 * @var JsonFactory
	 */
	protected $resultJsonFactory;

	/**
	 * @var PageRepositoryInterface
	 */
	protected $pageRepository;

	/**
	 * View constructor.
	 * @param Context $context
	 * @param ForwardFactory $resultForwardFactory
	 * @param PageRepositoryInterface $pageRepository
	 * @param JsonFactory $resultJsonFactory
	 * @param ScopeConfigInterface|null $scopeConfig
	 * @param Page|null $page
	 */
	public function __construct(
		Context $context,
		ForwardFactory $resultForwardFactory,
		PageRepositoryInterface $pageRepository,
		JsonFactory $resultJsonFactory,
		ScopeConfigInterface $scopeConfig = null,
		Page $page = null
	)
	{
		$this->resultJsonFactory = $resultJsonFactory;
		$this->pageRepository = $pageRepository;
		parent::__construct($context, $resultForwardFactory, $scopeConfig, $page);
	}

	/**
	 * @return bool|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Forward|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		if ($this->getRequest()->isAjax()) {
			$data = ['status' => 'success', 'message' => ''];

			$pageId = $this->getRequest()->getParam('page_id', $this->getRequest()->getParam('id', false));
			$resultJson = $this->resultJsonFactory->create();

			try {
				$page = $this->pageRepository->getById($pageId);
				$data['title'] = $page->getTitle();
				$data['content'] = $page->getContent();
			} catch (\Exception $e) {
				$data['status'] = 'error';
				$data['message'] = 'Something wrong';
			}
			$resultJson->setData($data);
			return $resultJson;
		}

		return parent::execute();
	}
}