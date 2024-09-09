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

namespace Plumrocket\Base\Model\External;

class Urls
{
    const CHANGELOGS_URL = 'store.plumrocket.com/media/info/changelogs_m2.xml';
    const VERSIONS_URL = 'media.store.plumrocket.com/media/info/versions.xml';
    const STATISTIC_URL = 'api.plumrocket.net/v1/statistic';
    const NOTIFICATIONS_URL = 'store.plumrocket.com/notificationmanager/feed/index';
    const PINGBACK_URL = 'store.plumrocket.com/ilg/pingback';
}
