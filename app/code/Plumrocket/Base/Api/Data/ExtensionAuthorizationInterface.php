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

namespace Plumrocket\Base\Api\Data;

/**
 * @since 2.5.0
 */
interface ExtensionAuthorizationInterface
{
    const SIGNATURE = 'signature';
    const STATUS = 'status';
    const DATE = 'date';

    /**
     * @return string
     */
    public function getModuleName(): string;

    /**
     * Check if product is in stock
     *
     * @return bool
     */
    public function isAuthorized(): bool;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int $status
     * @return \Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface
     */
    public function setStatus(int $status): ExtensionAuthorizationInterface;

    /**
     * @param string $signature
     * @return \Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface
     */
    public function setSignature(string $signature): ExtensionAuthorizationInterface;

    /**
     * @return string
     */
    public function getDate(): string;

    /**
     * @param string $date
     * @return \Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface
     */
    public function setDate(string $date): ExtensionAuthorizationInterface;

    /**
     * @return bool
     */
    public function isCached(): bool;
}
