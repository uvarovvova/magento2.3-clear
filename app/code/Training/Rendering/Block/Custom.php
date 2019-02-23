<?php
namespace Training\Rendering\Block;

use Magento\Catalog\Helper\Data;
use Magento\Framework\View\Element\Template\Context;

class Custom extends \Magento\Framework\View\Element\Template
{
    protected $catalogHelper;

    /**
     * @param Context $context
     * @param Data $catalogHelper
     * @param array $data
     */
    public function __construct(Context $context, Data $catalogHelper, array $data = [])
    {
        $this->catalogHelper = $catalogHelper;
        parent::__construct($context, $data);
    }

    public function canShowLink()
    {
        return $this->catalogHelper->isPriceGlobal();
    }

    public function getActionUrl()
    {
        return $this->_urlBuilder->getUrl('training_rendering/index/page');
    }
}
