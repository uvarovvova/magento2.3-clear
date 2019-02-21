<?php

namespace Training\Rendering\ViewModel;

use Magento\Framework\UrlInterface;

/**
 * Class Form
 * @package Training\Rendering\ViewModel
 */
class Form implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

	/**
	 * @var \Magento\Framework\UrlInterface
	 */
	private $urlBuilder;

	/**
	 * @param \Magento\Framework\UrlInterface $urlBuilder
	 */
	public function __construct(
		UrlInterface $urlBuilder
	) {
		$this->urlBuilder = $urlBuilder;
	}

	/**
	 * @return string
	 */
	public function getSubmitUrl()
	{
		return $this->urlBuilder->getUrl('customer/account/login');
	}
}
