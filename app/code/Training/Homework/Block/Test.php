<?php

namespace Training\homework\Block;

use Magento\Framework\View\Element\AbstractBlock;

/**
 * Class Test
 * @package Training\homework\Block
 */
class Test extends AbstractBlock
{
	public function _toHtml()
	{
		return "<b>Hello world from block!</b>";
	}
}