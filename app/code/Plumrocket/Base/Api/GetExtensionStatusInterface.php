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

namespace Plumrocket\Base\Api;

/**
 * Allow easily retrieve status of Plumrocket extension
 *
 * @since 2.3.9
 */
interface GetExtensionStatusInterface
{
    /**
     * Not installed
     * @deprecated since 2.4.1
     * @see \Plumrocket\Base\Api\ExtensionStatusInterface::NOT_INSTALLED
     */
    const MODULE_STATUS_NOT_INSTALLED = ExtensionStatusInterface::NOT_INSTALLED;

    /**
     * Installed but disabled in system config
     * @deprecated since 2.4.1
     * @see \Plumrocket\Base\Api\ExtensionStatusInterface::DISABLED
     */
    const MODULE_STATUS_DISABLED = ExtensionStatusInterface::DISABLED;

    /**
     * Installed, enabled in CLI and system config
     * @deprecated since 2.4.1
     * @see \Plumrocket\Base\Api\ExtensionStatusInterface::ENABLED
     */
    const MODULE_STATUS_ENABLED = ExtensionStatusInterface::ENABLED;

    /**
     * Retrieve status of Plumrocket module
     *
     * @param string $moduleName e.g. SocialLoginFree
     * @return int
     */
    public function execute(string $moduleName): int;
}
