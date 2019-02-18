<?php

namespace Training\Homework\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\LayoutFactory;

/**
 * Class Index
 * @package Training\Homework\Controller\Index
 */
class Index extends Action
{
	/**
	 * @var \Magento\Framework\View\LayoutFactory
	 */
	private $layoutFactory;

	/**
	 * Index constructor.
	 * @param Context $context
	 * @param LayoutFactory $layoutFactory
	 */
	public function __construct(
		Context $context,
		LayoutFactory $layoutFactory
	)
	{
		parent::__construct($context);
		$this->layoutFactory = $layoutFactory;
	}

	/**
	 * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
	 */
	public function execute()
	{
		$layout = $this->layoutFactory->create();
		$block = $layout->createBlock('Training\Homework\Block\Test');
		return $this->getResponse()->appendBody($block->toHtml());
	}
}