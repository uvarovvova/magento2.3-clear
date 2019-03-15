<?php

namespace Training\Feedback\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Training\Feedback\Model\Feedback as FeedbackModel;

/**
 * Class Feedback
 * @package Training\Feedback\Model\ResourceModel
 */
class Feedback extends AbstractDb
{
	/**
	 * Init
	 */
	protected function _construct()
	{
		$this->_init('training_feedback', 'feedback_id');
	}

	/**
	 * @return string
	 */
	public function getAllFeedbackNumber()
	{
		$adapter = $this->getConnection();
		$select = $adapter->select()
			->from('training_feedback', new \Zend_Db_Expr('COUNT(*)'));
		return $adapter->fetchOne($select);
	}

	/**
	 * @return string
	 */
	public function getActiveFeedbackNumber()
	{
		$adapter = $this->getConnection();
		$select = $adapter->select()
			->from('training_feedback', new \Zend_Db_Expr('COUNT(*)'))
			->where('is_active = ?', FeedbackModel::STATUS_ACTIVE);
		return $adapter->fetchOne($select);
	}
}