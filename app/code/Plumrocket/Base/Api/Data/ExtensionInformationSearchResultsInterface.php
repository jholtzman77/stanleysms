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

namespace Plumrocket\Base\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @since 2.5.0
 */
interface ExtensionInformationSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get extension information list.
     *
     * @return \Plumrocket\Base\Api\Data\ExtensionInformationInterface[]
     */
    public function getItems() : array;

    /**
     * Set extension information list.
     *
     * @param \Plumrocket\Base\Api\Data\ExtensionInformationInterface[] $items
     * @return $this
     */
    public function setItems(array $items) : self;
}
