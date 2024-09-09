<?php
/**
 * Plumrocket Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End-user License Agreement
 * that is available through the world-wide-web at this URL:
 * http://wiki.plumrocket.net/wiki/EULA
 * If you are unable to obtain it through the world-wide-web, please
 * send an email to support@plumrocket.com so we can send you a copy immediately.
 *
 * @package     Plumrocket_Base
 * @copyright   Copyright (c) 2021 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

declare(strict_types=1);

namespace Plumrocket\Base\Model\Extension\Customer;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Plumrocket\Base\Model\Extension\GetModuleName;

/**
 * Retrieve true customer key when customer had bought extension from marketplace
 *
 * @since 2.5.0
 */
class GetTrueCustomerKey
{
    /**
     * @var \Plumrocket\Base\Model\Extension\Customer\GetKey
     */
    private $getKey;

    /**
     * @var \Plumrocket\Base\Model\Extension\Customer\IsMarketplaceKey
     */
    private $isMarketplaceKey;

    /**
     * @var \Plumrocket\Base\Model\Extension\GetModuleName
     */
    private $getModuleName;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param \Plumrocket\Base\Model\Extension\Customer\GetKey           $getKey
     * @param \Plumrocket\Base\Model\Extension\Customer\IsMarketplaceKey $isMarketplaceKey
     * @param \Plumrocket\Base\Model\Extension\GetModuleName             $getModuleName
     * @param \Magento\Framework\App\Config\ScopeConfigInterface         $scopeConfig
     */
    public function __construct(
        GetKey $getKey,
        IsMarketplaceKey $isMarketplaceKey,
        GetModuleName $getModuleName,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->getKey = $getKey;
        $this->isMarketplaceKey = $isMarketplaceKey;
        $this->getModuleName = $getModuleName;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param string $moduleName e.g. SocialLoginFree or Plumrocket_SocialLoginFree
     * @return string
     */
    public function execute(string $moduleName): string
    {
        $moduleName = $this->getModuleName->execute($moduleName);
        $customerKey = $this->getKey->execute($moduleName);
        if ($this->isMarketplaceKey->execute($customerKey)) {
            $customerKey = $this->getFromConfig($moduleName) ?: $customerKey;
        }

        return $customerKey;
    }

    /**
     * @param string $moduleName e.g. SocialLoginFree
     * @return string
     */
    private function getFromConfig(string $moduleName): string
    {
        return (string) $this->scopeConfig->getValue("$moduleName/module/data");
    }
}
