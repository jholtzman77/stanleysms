<?php
/**
 * Created by PhpStorm.
 * User: hervetribouilloy
 * Date: 11/08/2018
 * Time: 16:13
 */

namespace Mbs\Title\Plugin;


class ProductTitleWithBrand
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $_coreRegistry;

    private static $attributePrefix = 'product_display';

    public function __construct(
        \Magento\Framework\Registry $_coreRegistry
    ) {
        $this->_coreRegistry = $_coreRegistry;
    }

    public function afterGetPageHeading(\Magento\Theme\Block\Html\Title $subject, $title)
    {
        if ($this->getProduct()) {
            $prefix = $this->getProduct()->getProductDisplay();
            if ($prefix) {
                $title = $prefix;
            }
        }

        return $title;
    }

    /**
     * Retrieve currently viewed product object
     *
     * @return \Magento\Catalog\Model\Product
     */
    private function getProduct()
    {
        return $this->_coreRegistry->registry('product');
    }
}
