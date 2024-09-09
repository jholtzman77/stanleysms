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

namespace Plumrocket\Base\Model\Extensions;

use Plumrocket\Base\Model\Extension\GetModuleName;

/**
 * @since 2.3.0
 * @deprecated since 2.5.0
 * @see \Plumrocket\Base\Model\Extension\Information\Get
 */
class GetInformation
{
    /**
     * @var \Plumrocket\Base\Api\ModuleInformationInterface[]
     */
    private $extensions;

    /**
     * @var \Plumrocket\Base\Model\Extension\GetModuleName
     */
    private $getExtensionName;

    /**
     * @param \Plumrocket\Base\Model\Extension\GetModuleName $getModuleName
     * @param array                                          $extensions
     */
    public function __construct(
        GetModuleName $getModuleName,
        array $extensions = []
    ) {
        $this->getExtensionName = $getModuleName;
        $this->extensions = $extensions;
    }

    /**
     * @param string $moduleName
     * @return \Plumrocket\Base\Api\ModuleInformationInterface|null
     */
    public function execute(string $moduleName)
    {
        $moduleName = $this->getExtensionName->execute($moduleName);
        return $this->extensions[$moduleName] ?? null;
    }
}
