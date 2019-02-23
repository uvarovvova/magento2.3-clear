<?php

namespace Training\Rendering\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Block extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    private $resultRawFactory;
    private $layoutFactory;

    /**
     * @param Context $context
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {
        parent::__construct($context);
        $this->layoutFactory = $layoutFactory;
        $this->resultRawFactory = $resultRawFactory;
    }

	/**
	 * @return $this|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
	 */
	public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock(\Training\Rendering\Block\Custom::class);
        $block->setTemplate('Training_Rendering::custom_block.phtml');
        $html = $block->toHtml();
        return $this->resultRawFactory->create()->setContents($html);
    }
}
