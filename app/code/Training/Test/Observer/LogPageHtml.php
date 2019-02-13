<?php

namespace Training\Test\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

/**
 * Class LogPageHtml
 * @package Training\Test\Observer
 */
class LogPageHtml implements ObserverInterface
{
	/**
	 * @var \Psr\Log\LoggerInterface
	 */
	private $logger;


	/**
	 * @param \Psr\Log\LoggerInterface $logger
	 */
	public function __construct(
		\Psr\Log\LoggerInterface $logger
	)
	{
		$this->logger = $logger;
	}

	/**
	 * @param Observer $observer
	 */
	public function execute(Observer $observer)
	{
		$response = $observer->getEvent()->getData('response');

		if (!$response) {
			return;
		}

		$this->logger->info($response->getBody());
	}
}