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

use Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface;

/**
 * Get new status from store
 *
 * @since 2.5.0
 */
class Refresh
{
    /**
     * @var \Plumrocket\Base\Model\Extension\Authorization\Status\Load
     */
    private $loadStatus;

    /**
     * @var \Plumrocket\Base\Model\Extension\Authorization\Status\Update
     */
    private $updateStatus;

    /**
     * @param \Plumrocket\Base\Model\Extension\Authorization\Status\Load   $loadStatus
     * @param \Plumrocket\Base\Model\Extension\Authorization\Status\Update $updateStatus
     */
    public function __construct(
        Load $loadStatus,
        Update $updateStatus
    ) {
        $this->loadStatus = $loadStatus;
        $this->updateStatus = $updateStatus;
    }

    /**
     * @param \Plumrocket\Base\Api\Data\ExtensionAuthorizationInterface $extensionAuthorization
     * @return mixed|string
     */
    public function execute(ExtensionAuthorizationInterface $extensionAuthorization)
    {
        $status = $this->loadStatus->execute($extensionAuthorization->getModuleName());
        if ($extensionAuthorization->getStatus() !== $status) {
            $this->updateStatus->execute($extensionAuthorization, $status);
        }

        return $extensionAuthorization;
    }
}
