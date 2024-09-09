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
 * @copyright   Copyright (c) 2020 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

declare(strict_types=1);

namespace Plumrocket\Base\Model\Extension\Status;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Module\Manager as ModuleManager;
use Magento\Framework\Module\ModuleListInterface;
use Plumrocket\Base\Api\ExtensionStatusInterface;
use Plumrocket\Base\Api\GetExtensionStatusInterface;
use Plumrocket\Base\Helper\Base;

/**
 * Class GetModuleVersion
 *
 * @since 2.3.9
 */
class Get implements GetExtensionStatusInterface
{
    /**
     * @var \Plumrocket\Base\Helper\Base
     */
    private $baseHelper;

    /**
     * @var ModuleManager
     */
    private $moduleManager;

    /**
     * @var \Magento\Framework\Module\ModuleListInterface
     */
    private $fullModuleList;

    /**
     * @param \Plumrocket\Base\Helper\Base                  $baseHelper
     * @param \Magento\Framework\Module\Manager             $moduleManager
     * @param \Magento\Framework\Module\ModuleListInterface $fullModuleList
     */
    public function __construct(
        Base $baseHelper,
        ModuleManager $moduleManager,
        ModuleListInterface $fullModuleList
    ) {
        $this->baseHelper = $baseHelper;
        $this->moduleManager = $moduleManager;
        $this->fullModuleList = $fullModuleList;
    }

    public function execute(string $moduleName): int
    {
        $hasModule = $this->moduleManager->isEnabled("Plumrocket_$moduleName");
        if (! $hasModule) {
            return $this->fullModuleList->has("Plumrocket_$moduleName")
                ? ExtensionStatusInterface::DISABLED_FROM_CLI
                : ExtensionStatusInterface::NOT_INSTALLED;
        }

        try {
            return $this->baseHelper->getConfigHelper($moduleName)->isModuleEnabled()
                ? ExtensionStatusInterface::ENABLED
                : ExtensionStatusInterface::DISABLED;
        } catch (NoSuchEntityException $e) {
            try {
                $dataHelper = $this->baseHelper->getModuleHelper($moduleName);
                if (method_exists($dataHelper, 'moduleEnabled')) {
                    return $dataHelper->moduleEnabled()
                        ? ExtensionStatusInterface::ENABLED
                        : ExtensionStatusInterface::DISABLED;
                }

                return ExtensionStatusInterface::ENABLED;
            } catch (NoSuchEntityException $e) {
                return ExtensionStatusInterface::ENABLED;
            }
        }
    }
}
