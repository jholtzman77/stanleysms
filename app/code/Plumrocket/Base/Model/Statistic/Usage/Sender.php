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

namespace Plumrocket\Base\Model\Statistic\Usage;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\SerializerInterface;
use Plumrocket\Base\Model\External\Urls;

/**
 * Send usage statistic
 *
 * @since 2.3.0
 */
class Sender
{
    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    private $serializer;

    /**
     * @param \Magento\Framework\HTTP\Client\Curl              $curl
     * @param \Magento\Framework\Serialize\SerializerInterface $serializer
     */
    public function __construct(
        Curl $curl,
        SerializerInterface $serializer
    ) {
        $this->curl = $curl;
        $this->serializer = $serializer;
    }

    /**
     * @param array $usageStatisticData
     * @return bool
     */
    public function send(array $usageStatisticData): bool
    {
        try {
            $this->curl->post(
                'https://' . Urls::STATISTIC_URL,
                $this->serializer->serialize($usageStatisticData)
            );
        } catch (\Exception $e) {
            return false;
        }

        return $this->curl->getStatus() === 200;
    }
}
