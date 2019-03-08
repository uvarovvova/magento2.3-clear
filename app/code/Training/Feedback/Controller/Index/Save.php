<?php

namespace Training\Feedback\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Training\Feedback\Model\FeedbackFactory;
use Training\Feedback\Model\ResourceModel\Feedback as FeedbackResource;


/**
 * Class Save
 * @package Training\Feedback\Controller\Index
 */
class Save extends Action
{
	/** @var FeedbackFactory */
	private $feedbackFactory;

	/** @var FeedbackResource */
	private $feedbackResource;

	/**
	 * Save constructor.
	 * @param Context $context
	 * @param FeedbackFactory $feedbackFactory
	 * @param FeedbackResource $feedbackResource
	 */
	public function __construct(
		Context $context,
		FeedbackFactory $feedbackFactory,
		FeedbackResource $feedbackResource
	)
	{
		$this->feedbackFactory = $feedbackFactory;
		$this->feedbackResource = $feedbackResource;
		parent::__construct($context);
	}

	/**
	 * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
	 */
	public function execute()
	{
		$result = $this->resultRedirectFactory->create();

		if ($post = $this->getRequest()->getPostValue()) {

			try {
				$this->validatePost($post);

				$feedback = $this->feedbackFactory->create();

				$feedback->setData($post);

				$this->feedbackResource->save($feedback);

				$this->messageManager->addSuccessMessage(
					__('Thank you for your feedback.')
				);

			} catch (\Exception $e) {

				$this->messageManager->addErrorMessage(
					__('An error occurred while processing your form. Please try again later.')
				);
				$result->setPath('*/*/form');
				return $result;
			}
		}

		$result->setPath('*/*/index');

		return $result;
	}

	/**
	 * @param $post
	 * @throws LocalizedException
	 * @throws \Exception
	 */
	private function validatePost($post)
	{
		if (!isset($post['author_name']) || trim($post['author_name']) === '') {
			throw new LocalizedException(__('Name is missing'));
		}
		if (!isset($post['message']) || trim($post['message']) === '') {
			throw new LocalizedException(__('Comment is missing'));
		}
		if (!isset($post['author_email']) || false === \strpos($post['author_email'], '@')) {
			throw new LocalizedException(__('Invalid email address'));
		}
		if (trim($this->getRequest()->getParam('hideit')) !== '') {
			throw new \Exception();
		}
	}
}