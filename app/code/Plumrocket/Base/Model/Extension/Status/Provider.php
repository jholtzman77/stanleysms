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

use Plumrocket\Base\Api\ExtensionStatusInterface;
use Plumrocket\Base\Api\GetExtensionStatusInterface;
use Plumrocket\Base\Model\Extension\GetModuleName;

/**
 * @since 2.4.1
 */
class Provider implements ExtensionStatusInterface
{
    /**
     * @var \Plumrocket\Base\Api\GetExtensionStatusInterface
     */
    private $getExtensionStatus;

    /**
     * @var \Plumrocket\Base\Model\Extension\GetModuleName
     */
    private $getExtensionName;

    /**
     * @param \Plumrocket\Base\Api\GetExtensionStatusInterface $getExtensionStatus
     * @param \Plumrocket\Base\Model\Extension\GetModuleName   $getExtensionName
     */
    public function __construct(
        GetExtensionStatusInterface $getExtensionStatus,
        GetModuleName $getExtensionName
    ) {
        $this->getExtensionStatus = $getExtensionStatus;
        $this->getExtensionName = $getExtensionName;
    }

    /**
     * @inheritDoc
     */
    public function isEnabled(string $moduleName): bool
    {
        return self::ENABLED === $this->getExtensionStatus->execute($this->getExtensionName->execute($moduleName));
    }

    /**
     * @inheritDoc
     */
    public function isDisabled(string $moduleName): bool
    {
        return self::DISABLED === $this->getExtensionStatus->execute($this->getExtensionName->execute($moduleName));
    }

    /**
     * @inheritDoc
     */
    public function isDisabledFromCli(string $moduleName): bool
    {
        $status = $this->getExtensionStatus->execute($this->getExtensionName->execute($moduleName));
        return self::DISABLED_FROM_CLI === $status;
    }

    /**
     * @inheritDoc
     */
    public function isNotInstalled(string $moduleName): bool
    {
        $status = $this->getExtensionStatus->execute($this->getExtensionName->execute($moduleName));
        return self::NOT_INSTALLED === $status;
    }
}
