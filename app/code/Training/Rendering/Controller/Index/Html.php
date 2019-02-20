<?php

namespace Training\Rendering\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\Context;

class Html extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    private $resultJsonFactory;
    private $resultLayoutFactory;

    /**
     * @param Context $context
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultLayoutFactory = $resultLayoutFactory;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        $resultLayout = $this->resultLayoutFactory->create();
//        return $resultLayout;

        $html = $resultLayout->getLayout()->getOutput();

        $separateBlock = $resultLayout->getLayout()->getBlock('rendering-detail-block-child');
        $resultJson = $this->resultJsonFactory->create();
        $data = ['separate_block' => $separateBlock->toHtml(), 'html' => $html];
        $resultJson->setData($data);
        return $resultJson;
    }
}

