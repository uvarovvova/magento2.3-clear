<?php

namespace Training\Homework\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\LayoutFactory;
use Magento\Framework\Controller\Result\RawFactory;

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
	 * @var RawFactory
	 */
	private $resultRawFactory;

	/**
	 * Index constructor.
	 * @param Context $context
	 * @param LayoutFactory $layoutFactory
	 * @param RawFactory $resultRawFactory
	 */
	public function __construct(
		Context $context,
		LayoutFactory $layoutFactory,
		RawFactory $resultRawFactory
	)
	{
		parent::__construct($context);
		$this->layoutFactory = $layoutFactory;
		$this->resultRawFactory = $resultRawFactory;
	}

	/**
	 * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
	 */
	public function execute()
	{
		$layout = $this->layoutFactory->create();
		$block = $layout->createBlock('Training\Homework\Block\Test');
		$resultRaw = $this->resultRawFactory->create();
		$resultRaw->setHeader('Content-Type', 'text/xml');
		$resultRaw->setContents($block->toHtml());
		return $resultRaw;
	}
}