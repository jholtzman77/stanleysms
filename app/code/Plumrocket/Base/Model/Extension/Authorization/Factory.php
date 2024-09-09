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

namespace Plumrocket\Base\Model\Extension\Authorization;

use Magento\Framework\ObjectManagerInterface;
use Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface;

/**
 * @since 2.5.0
 */
class Factory
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param string $moduleName
     * @return \Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface|Data\ExtensionAuthorization
     */
    public function create(string $moduleName): ExtensionAuthorizationInterface
    {
        return $this->objectManager->create(ExtensionAuthorizationInterface::class, ['name' => $moduleName]);
    }
}
