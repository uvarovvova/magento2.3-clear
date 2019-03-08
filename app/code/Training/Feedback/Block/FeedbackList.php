<?php

namespace Training\Feedback\Block;


use Magento\Framework\Stdlib\DateTime\Timezone;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory;
use Magento\Framework\DataObject;
use Training\Feedback\Model\ResourceModel\Feedback;

/**
 * Class FeedbackList
 * @package Training\Feedback\Block
 */
class FeedbackList extends Template
{
	const PAGE_SIZE = 5;

	/**
	 * @var CollectionFactory
	 */
	private $collectionFactory;

	/**
	 * @var Timezone
	 */
	private $timezone;


	private $collection;

	/**
	 * @var Feedback
	 */
	private $feedbackResource;


	/**
	 * FeedbackList constructor.
	 * @param Context $context
	 * @param CollectionFactory $collectionFactory
	 * @param Timezone $timezone
	 * @param Feedback $feedbackResource
	 * @param array $data
	 */
	public function __construct(
		Context $context,
		CollectionFactory $collectionFactory,
		Timezone $timezone,
		Feedback $feedbackResource,
		array $data = array()
	)
	{
		parent::__construct($context, $data);
		$this->collectionFactory = $collectionFactory;
		$this->timezone = $timezone;
		$this->feedbackResource = $feedbackResource;
	}

	/**
	 * @return mixed
	 */
	public function getFeedbackCollection()
	{
		if (!$this->collection) {
			$this->collection = $this->collectionFactory->create();
			$this->collection->addFieldToFilter('is_active', 1);
			$this->collection->setOrder('creation_time', 'DESC');
		}
		return $this->collection;
	}

	/**
	 * @return string
	 */
	public function getPagerHtml()
	{
		$pagerBlock = $this->getChildBlock('feedback_list_pager');
		if ($pagerBlock instanceof DataObject) {

			/* @var $pagerBlock \Magento\Theme\Block\Html\Pager */
			$pagerBlock
				->setUseContainer(false)
				->setShowPerPage(false)
				->setShowAmounts(false)
				->setLimit($this->getLimit())
				->setCollection($this->getFeedbackCollection());
			return $pagerBlock->toHtml();
		}
		return '';
	}

	/**
	 * @return int
	 */
	public function getLimit()
	{
		return static::PAGE_SIZE;
	}

	/**
	 * @return string
	 */
	public function getAddFeedbackUrl()
	{
		return $this->getUrl('training_feedback/index/save');
	}

	/**
	 * @param $feedback
	 * @return string
	 */
	public function getFeedbackDate($feedback)
	{
		return $this->timezone->formatDateTime($feedback->getCreationTime());
	}

	/**
	 * @return string
	 */
	public function getAllFeedbackNumber()
	{
		return $this->feedbackResource->getAllFeedbackNumber();
	}

	/**
	 * @return string
	 */
	public function getActiveFeedbackNumber()
	{
		return $this->feedbackResource->getActiveFeedbackNumber();
	}
}