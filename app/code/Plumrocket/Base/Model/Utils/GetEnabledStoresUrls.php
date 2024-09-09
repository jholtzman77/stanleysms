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

use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Plumrocket\Base\Helper\Config;

/**
 * @since 2.5.0
 */
class GetEnabledStoresUrls
{
    /**
     * @var \Plumrocket\Base\Helper\Config
     */
    private $config;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param \Plumrocket\Base\Helper\Config             $config
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        Config $config,
        StoreManagerInterface $storeManager
    ) {
        $this->config = $config;
        $this->storeManager = $storeManager;
    }

    /**
     * Retrieve list of unique enabled stores urls
     *
     * @return array
     */
    public function execute(): array
    {
        $storesUrls = [];
        foreach ($this->storeManager->getStores() as $store) {
            if ($store->getIsActive()) {
                $storesUrls[] = $this->config->getConfig(
                    Store::XML_PATH_SECURE_BASE_URL,
                    $store->getId(),
                    ScopeInterface::SCOPE_STORE
                );
            }
        }

        return array_unique($storesUrls);
    }
}
