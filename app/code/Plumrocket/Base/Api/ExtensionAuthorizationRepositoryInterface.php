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

namespace Plumrocket\Base\Api;

use Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface;

/**
 * @since 2.5.0
 */
interface ExtensionAuthorizationRepositoryInterface
{
    /**
     * @param string $moduleName
     * @return \Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(string $moduleName): ExtensionAuthorizationInterface;

    /**
     * @param \Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface $extension
     * @return \Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface
     */
    public function save(ExtensionAuthorizationInterface $extension): ExtensionAuthorizationInterface;
}
