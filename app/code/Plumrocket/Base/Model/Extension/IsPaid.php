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

namespace Plumrocket\Base\Model\Extension;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Plumrocket\Base\Api\GetExtensionInformationInterface;

/**
 * @since 2.5.0
 */
class IsPaid
{
    /**
     * @var \Plumrocket\Base\Api\GetExtensionInformationInterface
     */
    private $getExtensionInformation;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param \Plumrocket\Base\Api\GetExtensionInformationInterface $getExtensionInformation
     * @param \Magento\Framework\App\Config\ScopeConfigInterface    $scopeConfig
     */
    public function __construct(
        GetExtensionInformationInterface $getExtensionInformation,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->getExtensionInformation = $getExtensionInformation;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute(string $moduleName): bool
    {
        $extensionInformation = $this->getExtensionInformation->execute($moduleName);
        $generalConfigurations = $this->scopeConfig->getValue(
            "{$extensionInformation->getConfigSection()}/general",
            ScopeInterface::SCOPE_STORE,
            0
        );

        if (is_array($generalConfigurations)) {
            return array_key_exists('serial', $generalConfigurations);
        }

        return false;
    }
}
