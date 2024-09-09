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

namespace Plumrocket\Base\Model\Extension\Authorization\Status;

use Plumrocket\Base\Model\Extension\Authorization\Key;

/**
 * @since 2.5.0
 */
class Calculate
{
    /**
     * @var \Plumrocket\Base\Model\Extension\Authorization\Key
     */
    private $key;

    /**
     * @param \Plumrocket\Base\Model\Extension\Authorization\Key $key
     */
    public function __construct(Key $key)
    {
        $this->key = $key;
    }

    public function execute(string $moduleName): int
    {
        $key = $this->key->get($moduleName);
        return (strlen($key) === 32 && $key[9] === $moduleName[2] && (strlen($moduleName) < 4
                || $key[20] === $moduleName[3])) ? 500 : 201;
    }
}
