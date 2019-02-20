<?php

namespace Training\Homework\Controller\Index;

use Magento\Framework\App\Action\Action as CoreAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\LayoutFactory;
use Magento\Framework\Controller\Result\RawFactory;
use Training\Homework\Block\TestTwo;

/**
 * Class Index
 * @package Training\Homework\Controller\Index
 */
class Action extends CoreAction
{
	/**
	 * @var \Magento\Framework\Controller\Result\RawFactory
	 */
	private $resultRawFactory;

	/**
	 * @var \Magento\Framework\View\LayoutFactory
	 */
	private $layoutFactory;

	/**
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
	 * @param \Magento\Framework\View\LayoutFactory $layoutFactory
	 */
	public function __construct(
		Context $context,
		RawFactory $resultRawFactory,
		LayoutFactory $layoutFactory
	)
	{
		parent::__construct($context);
		$this->resultRawFactory = $resultRawFactory;
		$this->layoutFactory = $layoutFactory;
	}

	/**
	 * @return $this|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
	 */
	public function execute()
	{

//		$layout = $this->layoutFactory->create();
//		$block = $layout->createBlock(Test::class);
//		$block->setTemplate('Training_Homework::test.phtml');
//
//		var_dump($block->toHtml());exit;
//
//		/** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
//		$resultRaw = $this->resultRawFactory->create();

//		return $resultRaw->setContents($block->toHtml());

		$layout = $this->layoutFactory->create();
		$block = $layout->createBlock(TestTwo::class);
		$block->setTemplate('Training_Homework::test.phtml');
		$html = $block->toHtml();
		return $this->resultRawFactory->create()->setContents($html);
	}
}