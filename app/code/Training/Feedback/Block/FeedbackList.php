<?php

namespace Training\Feedback\Block;


use Magento\Framework\Stdlib\DateTime\Timezone;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory;
use Magento\Framework\DataObject;

/**
 * Class FeedbackList
 * @package Training\Feedback\Block
 */
class FeedbackList extends Template
{
	const PAGE_SIZE = 5;
	private $collectionFactory;
	private $collection;
	private $timezone;

	public function __construct(
		Context $context,
		CollectionFactory $collectionFactory,
		Timezone $timezone,
		array $data = array()
	)
	{
		parent::__construct($context, $data);
		$this->collectionFactory = $collectionFactory;
		$this->timezone = $timezone;
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
}