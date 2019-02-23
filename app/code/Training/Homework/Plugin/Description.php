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
		if ($subject->getNameInLayout() == 'product.info.sku') {
			$subject->setTemplate('Training_Homework::description.phtml');
		}
	}
}