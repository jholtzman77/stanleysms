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

namespace Plumrocket\Base\Api;

use Plumrocket\Base\Api\Data\ExtensionInformationInterface;

/**
 * Allow easily retrieve information about installed modules
 *
 * @since 2.3.0
 * @deprecated since 2.5.0
 * @see \Plumrocket\Base\Api\Data\ExtensionInformationInterface
 */
interface ModuleInformationInterface extends ExtensionInformationInterface
{
    /**
     * Retrieve name of module, e.g. Twitter & Facebook Login
     *
     * @deprecated since 2.4.0
     * @see getTitle()
     * @return string
     */
    public function getOfficialName(): string;
}
