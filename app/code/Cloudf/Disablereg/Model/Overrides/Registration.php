<?php
namespace Cloudf\Disablereg\Model\Overrides;
class Registration extends \Magento\Customer\Model\Registration {

    private $scopeConfig;
    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isAllowed() {
        return false;
    }
}