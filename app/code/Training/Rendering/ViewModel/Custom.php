<?php
namespace Training\Rendering\ViewModel;

use Magento\Catalog\Helper\Data;
use Magento\Framework\UrlInterface;

class Custom implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    private $catalogHelper;
    private $urlBuilder;

    /**
     * @param Data $catalogHelper
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        Data $catalogHelper,
        UrlInterface $urlBuilder
    ) {
        $this->catalogHelper = $catalogHelper;
        $this->urlBuilder = $urlBuilder;
    }

    public function canShowLink()
    {
        return $this->catalogHelper->isPriceGlobal();
    }

    public function getActionUrl()
    {
        return $this->urlBuilder->getUrl('training_rendering/index/page');
    }
}
