<?php

namespace Training\Feedback\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Form
 * @package Training\Feedback\Controller\Index
 */
class Form extends Action
{
	/** @var PageFactory */
	private $pageResultFactory;

	/**
	 * Form constructor.
	 * @param Context $context
	 * @param PageFactory $pageResultFactory
	 */
	public function __construct(
		Context $context,
		PageFactory $pageResultFactory
	)
	{
		$this->pageResultFactory = $pageResultFactory;
		parent::__construct($context);
	}

	/**  */
	public function execute()
	{
		$result = $this->pageResultFactory->create();
		return $result;
	}
}