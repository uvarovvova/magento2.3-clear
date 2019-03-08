<?php

namespace Training\Feedback\ViewModel;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Feedback implements ArgumentInterface
{

	private $urlBuilder;

	/**
	 * @param UrlInterface $urlBuilder
	 */
	public function __construct(
		UrlInterface $urlBuilder
	)
	{
		$this->urlBuilder = $urlBuilder;
	}

	/**
	 * @return string
	 */
	public function getActionUrl()
	{
		return $this->urlBuilder->getUrl('training_feedback/index/save');
	}
}
