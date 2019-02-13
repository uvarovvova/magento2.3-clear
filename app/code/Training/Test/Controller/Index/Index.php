<?php

namespace Training\Test\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;

/**
 * Class Index
 * @package Training\Test\Controller\Index
 */
class Index extends Action
{
	private $resultRawFactory;

	/**
	 * Index constructor.
	 * @param Context $context
	 * @param RawFactory $resultRawFactory
	 */
	public function __construct(
		Context $context,
		RawFactory $resultRawFactory
	)
	{
		parent::__construct($context);
		$this->resultRawFactory = $resultRawFactory;
	}

	/**
	 * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Raw|\Magento\Framework\Controller\ResultInterface
	 */
	public function execute()
	{
		$xml = '<router id="standard">
                    <route id="test" frontName="test">
                        <module name="Training_Test" />
                    </route>
                </router>';

		$resultRaw = $this->resultRawFactory->create();
		$resultRaw->setHeader('Content-Type', 'text/xml');
		$resultRaw->setContents($xml);
		return $resultRaw;
	}
}