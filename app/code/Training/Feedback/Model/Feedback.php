<?php

namespace Training\Feedback\Model;

use Magento\Framework\Model\AbstractModel;
use Training\Feedback\Model\ResourceModel\Feedback as ResoureFeedback;

class Feedback extends AbstractModel
{

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;

	/**
	 * Init
	 */
	protected function _construct()
	{
		$this->_init(ResoureFeedback::class);
	}
}