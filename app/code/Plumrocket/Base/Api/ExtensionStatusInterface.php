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
 * @since 2.4.1
 */
interface ExtensionStatusInterface
{
    /**
     * Not installed in magento
     */
    const NOT_INSTALLED = 0;

    /**
     * Installed but disabled from CLI
     */
    const DISABLED_FROM_CLI = 3;

    /**
     * Installed but disabled in system config
     */
    const DISABLED = 1;

    /**
     * Installed, enabled in CLI and system config
     */
    const ENABLED = 2;

    /**
     * Check whether extension is installed, enabled in CLI and in Store -> Configuration
     *
     * @param string $moduleName either Plumrocket_SocialLoginFree or SocialLoginFree
     * @return bool
     */
    public function isEnabled(string $moduleName): bool;

    /**
     * Check whether module is disabled in Store -> Configuration
     *
     * @param string $moduleName either Plumrocket_SocialLoginFree or SocialLoginFree
     * @return bool
     */
    public function isDisabled(string $moduleName): bool;

    /**
     * Check whether extension is disabled from cli
     *
     * @param string $moduleName either Plumrocket_SocialLoginFree or SocialLoginFree
     * @return bool
     */
    public function isDisabledFromCli(string $moduleName): bool;

    /**
     * Check whether extension is not installed
     *
     * @param string $moduleName either Plumrocket_SocialLoginFree or SocialLoginFree
     * @return bool
     */
    public function isNotInstalled(string $moduleName): bool;
}
