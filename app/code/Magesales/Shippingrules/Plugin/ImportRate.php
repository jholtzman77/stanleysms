<?php
namespace Magesales\Shippingrules\Plugin;

class ImportRate
{
    public function aroundImportShippingRate(
        \Magento\Quote\Model\Quote\Address\Rate $subject,
        \Closure $closure,
        \Magento\Quote\Model\Quote\Address\RateResult\AbstractResult $rate
    )
    {
        $rateData = $closure($rate);;
        $rateData->setOldPrice($rate->getOldPrice());
        return $rateData;
    }
}