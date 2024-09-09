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

namespace Plumrocket\Base\Model\Utils;

use Magento\Framework\App\RequestInterface;

/**
 * @since 2.5.0
 */
interface DeviceDetectInterface
{
    /**
     * Check whether current device is mobile
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function isMobile(RequestInterface $request): bool;

    /**
     * Check whether current device is tablet
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function isTablet(RequestInterface $request): bool;
}
