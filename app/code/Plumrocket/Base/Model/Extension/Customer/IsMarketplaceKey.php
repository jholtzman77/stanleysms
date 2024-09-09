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

/**
 * Check whether customer key is marketplace
 *
 * @since 2.5.0
 */
class IsMarketplaceKey
{
    const MARKETPLACE_CUSTOMER_KEY = '532416486b540ea2a1e50c4070b671611b44f52718';

    public function execute(string $customerKey): bool
    {
        return self::MARKETPLACE_CUSTOMER_KEY === $customerKey;
    }
}
