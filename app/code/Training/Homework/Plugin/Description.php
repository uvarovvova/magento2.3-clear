<?php

namespace Training\Homework\Plugin;

use Magento\Catalog\Block\Product\View\Description as CoreDescription;

class Description
{
	public function beforeToHtml(CoreDescription $subject)
	{
		$subject->getProduct()->setDescription('Test description');
	}
}