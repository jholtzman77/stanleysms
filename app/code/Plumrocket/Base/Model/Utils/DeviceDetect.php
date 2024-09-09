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

use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Plumrocket\Base\Library\Mobile\Detect;

/**
 * @since 2.5.0
 */
class DeviceDetect implements DeviceDetectInterface
{
    /**
     * @var \Plumrocket\Base\Library\Mobile\Detect
     */
    private $mobileDetect;

    /**
     * @var bool[]
     */
    private $cache = [];

    /**
     * @param \Plumrocket\Base\Library\Mobile\Detect $mobileDetect
     */
    public function __construct(Detect $mobileDetect)
    {
        $this->mobileDetect = $mobileDetect;
    }

    /**
     * @inheritDoc
     */
    public function isMobile(RequestInterface $request): bool
    {
        if (! $request instanceof Http) {
            return false;
        }

        $key = 'mobile';
        if (! isset($this->cache[$key])) {
            $this->cache[$key] = $this->mobileDetect->isMobile();
        }

        return $this->cache[$key];
    }

    /**
     * @inheritDoc
     */
    public function isTablet(RequestInterface $request): bool
    {
        if (! $request instanceof Http) {
            return false;
        }

        $key = 'tablet';
        if (! isset($this->cache[$key])) {
            $this->cache[$key] = $this->mobileDetect->isTablet();
        }

        return $this->cache[$key];
    }
}
