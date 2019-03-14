<?php

namespace Training\Feedback\Model\ResourceModel\Feedback;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\Feedback\Model\Feedback;
use Training\Feedback\Model\ResourceModel\Feedback as ResourceFeedback;

/**
 * Class Collection
 * @package Training\Feedback\Model\ResourceModel\Feedback
 */
class Collection extends AbstractCollection
{

	protected $_eventPrefix = 'training_feedback_collection';
	protected $_eventObject = 'feedback_collection';

	/**
	 *
	 */
	protected function _construct()
	{
		$this->_init(
			Feedback::class,
			ResourceFeedback::class
		);
	}
}
