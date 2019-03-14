<?php

namespace Training\Feedback\Controller\Index;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

use Magento\Framework\App\Action\Context;
use Training\Feedback\Api\Data\FeedbackInterfaceFactory;
use Training\Feedback\Api\FeedbackRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;

class Test extends \Magento\Framework\App\Action\Action
{

	/**
	 * @var FeedbackInterfaceFactory
	 */
	private $feedbackFactory;

	/**
	 * @var FeedbackRepositoryInterface
	 */
	private $feedbackRepository;

	/**
	 * @var SearchCriteriaBuilder
	 */
	private $searchCriteriaBuilder;

	/**
	 * @var SortOrderBuilder
	 */
	private $sortOrderBuilder;

	/**
	 * Test constructor.
	 * @param Context $context
	 * @param FeedbackInterfaceFactory $feedbackFactory
	 * @param FeedbackRepositoryInterface $feedbackRepository
	 * @param SearchCriteriaBuilder $searchCriteriaBuilder
	 * @param SortOrderBuilder $sortOrderBuilder
	 */
	public function __construct(
		Context $context,
		FeedbackInterfaceFactory $feedbackFactory,
		FeedbackRepositoryInterface $feedbackRepository,
		SearchCriteriaBuilder $searchCriteriaBuilder,
		SortOrderBuilder $sortOrderBuilder
	)
	{
		$this->feedbackFactory = $feedbackFactory;
		$this->feedbackRepository = $feedbackRepository;
		$this->searchCriteriaBuilder = $searchCriteriaBuilder;
		$this->sortOrderBuilder = $sortOrderBuilder;
		parent::__construct($context);
	}


	/**
	 * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
	 */
	public function execute()
	{

		// create new item
		$newFeedback = $this->feedbackFactory->create();

		try {
			$newFeedback->setAuthorName('some name');
			$newFeedback->setAuthorEmail('test@test.com');
			$newFeedback->setMessage('ghj dsghjfghs sghkfgsdhfkj sdhjfsdf gsfkj');
			$newFeedback->setIsActive(1);

			$this->feedbackRepository->save($newFeedback);

			// load item by id
			$feedback = $this->feedbackRepository->getById(4);
			$this->printFeedback($feedback);

			// update item
			$feedbackToUpdate = $this->feedbackRepository->getById(4);
			$feedbackToUpdate->setMessage('CUSTOM ' . $feedbackToUpdate->getMessage());

			// delete feedback
			$this->feedbackRepository->deleteById(4);

			// load multiple items
			$this->searchCriteriaBuilder
				->addFilter('is_active', 1);

			$sortOrder = $this->sortOrderBuilder
				->setField('title')
				->setAscendingDirection()
				->create();

			$this->searchCriteriaBuilder->addSortOrder($sortOrder);
			$searchCriteria = $this->searchCriteriaBuilder->create();
			$searchResult = $this->feedbackRepository->getList($searchCriteria);

			foreach ($searchResult->getItems() as $item) {
				$this->printFeedback($item);
			}

			exit();

		} catch (\Exception $e) {
			echo $e->getMessage();exit;
		}

	}

	private function printFeedback($feedback)
	{
		echo $feedback->getId() . ' : '
			. $feedback->getAuthorName()
			. ' (' . $feedback->getAuthorEmail() . ')';
		echo "<br/>\n";
	}
}