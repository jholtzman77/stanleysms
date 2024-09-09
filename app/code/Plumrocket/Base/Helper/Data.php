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

namespace Plumrocket\Base\Helper;

use Plumrocket\Base\Model\Extensions\Information;

/**
 * @deprecated since 2.5.0 - this class will be removed
 */
class Data extends Main
{
    /**
     * @var string
     */
    protected $_configSectionId = Information::CONFIG_SECTION;

    /**
     * Receive true if Plumrocket module is enabled
     *
     * @param  string $store
     * @return bool
     * @suspendWarning
     * @noinspection PhpUnusedParameterInspection
     */
    public function moduleEnabled($store = null)
    {
        return true;
    }
}
