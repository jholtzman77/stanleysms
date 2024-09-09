<?php
namespace Magesales\Shippingrules\Model;

class Rule extends \Magento\Rule\Model\AbstractModel
{
    const CALC_REPLACE = 0;
    const CALC_ADD     = 1;
    const CALC_DEDUCT  = 2;
    protected $objectManager;
    protected $storeManager;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {

        $this->objectManager = $objectManager;
        $this->storeManager = $storeManager;
        parent::__construct(
            $context, $registry, $formFactory, $localeDate, null, null, $data
        );

    }

    public function validate(\Magento\Framework\DataObject $object)
    {
        return $this->getConditions()->validateNotModel($object);
    }


    protected function _construct()
    {
        $this->_init('Magesales\Shippingrules\Model\Resource\Rule');
        parent::_construct();
    }


    public function getConditionsInstance()
    {
        return $this->objectManager->create('Magesales\Shippingrules\Model\Rule\Condition\Combine');
    }

    public function getActionsInstance()
    {
        return $this->objectManager->create('Magento\SalesRule\Model\Rule\Condition\Product\Combine');
    }

    public function massChangeStatus($ids, $status)
    {
        return $this->getResource()->massChangeStatus($ids, $status);
    }

    public function loadPost(array $rule)
    {
        $arr = $this->_convertFlatToRecursive($rule);
        if (isset($arr['conditions'])) {
            $this->getConditions()->setConditions(array())->loadArray($arr['conditions'][1]);
        }
        if (isset($arr['actions'])) {
            $this->getActions()->setActions(array())->loadArray($arr['actions'][1], 'actions');
        }
        return $this;
    }

    public function match($rate)
    {
        if (false === strpos($this->getCarriers(), ',' . $rate->getCarrier(). ',')){
            return false;
        }

        $m = $this->getMethods();
        $m = str_replace("\r\n", "\n", $m);
        $m = str_replace("\r", "\n", $m);
        $m = trim($m);
        if (!$m){ 
            return true;
        }

        $m = array_unique(explode("\n", $m));
        foreach ($m as $pattern){
            $pattern = '/' . trim($pattern) . '/i';
            if (preg_match($pattern, $rate->getMethodTitle())){
                return true;
            }
        }
        return false;
    }

    public function validateTotals($totals)
    {
        $keys = array('price', 'qty', 'weight');
        foreach ($keys as $k){
            $v = $this->getIgnorePromo() ? $totals[$k] : $totals['not_free_' . $k];
            if ($this->getData($k . '_from') > 0 && $v < $this->getData($k . '_from')){
                return false;
            }

            if ($this->getData($k . '_to')   > 0 && $v > $this->getData($k . '_to')){
                return false;
            }
        }

        return true;
    }

    public function calculateFee($totals, $isFree)
    {
        if ($isFree && !$this->getIgnorePromo()){
            $this->setFee(0);
            return 0;
        }

        $rate = 0;

        $qty = $this->getIgnorePromo() ? $totals['qty'] : $totals['not_free_qty'];
        $weight = $this->getIgnorePromo() ? $totals['weight'] : $totals['not_free_weight'];
        if ($qty > 0){
            $rate += $this->getRateBase();
        }

        $rate += $qty * $this->getRateFixed();

        $price = $this->getIgnorePromo() ? $totals['price'] : $totals['not_free_price'];
        $rate += $price * $this->getRatePercent() / 100;
        $rate += $weight * $this->getWeightFixed();

        if ($this->getCalc() == self::CALC_DEDUCT){
            $rate = 0 - $rate;
        }

        $this->setFee($rate);

        return $rate;
    }

    public function removeFromRequest()
    {
        return ($this->getCalc() == self::CALC_REPLACE);
    }

    public function afterSave()
    {
        $ruleProductAttributes = array_merge(
            $this->_getUsedAttributes($this->getConditionsSerialized()),
            $this->_getUsedAttributes($this->getActionsSerialized())
        );
        if (count($ruleProductAttributes)) {
            $this->getResource()->saveAttributes($this->getId(), $ruleProductAttributes);
        }

        return parent::afterSave();
    }

    protected function _getUsedAttributes($serializedString)
    {
        $result = array();
        $pattern = '~s:46:"Magento\\\SalesRule\\\Model\\\Rule\\\Condition\\\Product";s:9:"attribute";s:\d+:"(.*?)"~s';
        $matches = array();
        if (preg_match_all($pattern, $serializedString, $matches)){
            foreach ($matches[1] as $attributeCode) {
                $result[] = $attributeCode;
            }
        }

        return $result;
    }


    protected function _setWebsiteIds()
    {
        $websites = array();

        foreach ($this->storeManager->getWebsites() as $website) {
            foreach ($website->getGroups() as $group) {
                $stores = $group->getStores();
                foreach ($stores as $store) {
                    $websites[$website->getId()] = $website->getId();
                }
            }
        }

        $this->setOrigData('website_ids', $websites);
    }



    public function beforeSave()
    {
        $this->_setWebsiteIds();
        return parent::beforeSave();
    }

    public function beforeDelete()
    {
        $this->_setWebsiteIds();
        return parent::beforeDelete();
    }

}