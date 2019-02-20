<?php

namespace Training\Homework\Plugin;

use Magento\Catalog\Block\Product\View\Description as CoreDescription;

/**
 * Class Description
 * @package Training\Homework\Plugin
 */
class Description
{
	/**
	 * @param CoreDescription $subject
	 */
	public function beforeToHtml(CoreDescription $subject)
	{
//		$subject->getLayout()->createBlock(\Training\Homework\Block\Test::class);
		$subject->setTemplate('Training_Homework::description.phtml');

	}
}