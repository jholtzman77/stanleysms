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

namespace Plumrocket\Base\Model\Product;

use Plumrocket\Base\Api\ProductStatusManagerInterface;
use Plumrocket\Base\Model\Extension\Status\Disable;
use Plumrocket\Base\Model\Extension\Status\IsEnabledOnAnyStoreView;

/**
 * @since 2.3.7
 */
class StatusManager implements ProductStatusManagerInterface
{
    /**
     * @var \Plumrocket\Base\Model\Extension\Status\Disable
     */
    private $disableCommand;

    /**
     * @var \Plumrocket\Base\Model\Extension\Status\IsEnabledOnAnyStoreView
     */
    private $isEnabledOnAnyStoreView;

    /**
     * @param \Plumrocket\Base\Model\Extension\Status\Disable                 $disableCommand
     * @param \Plumrocket\Base\Model\Extension\Status\IsEnabledOnAnyStoreView $isEnabledOnAnyStoreView
     */
    public function __construct(
        Disable $disableCommand,
        IsEnabledOnAnyStoreView $isEnabledOnAnyStoreView
    ) {
        $this->disableCommand = $disableCommand;
        $this->isEnabledOnAnyStoreView = $isEnabledOnAnyStoreView;
    }

    public function isEnabled(string $moduleName): bool
    {
        return $this->isEnabledOnAnyStoreView->execute($moduleName);
    }

    public function disable(string $moduleName): bool
    {
        return $this->disableCommand->execute($moduleName);
    }
}
