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

namespace Plumrocket\Base\Model\Extension\Updates;

use Plumrocket\Base\Model\Extension\GetModuleName;
use Plumrocket\Base\Model\External\Urls;

/**
 * @since 2.5.0
 */
class GetLastVersionMessage
{
    /**
     * @var \Plumrocket\Base\Model\Extension\GetModuleName
     */
    private $getModuleName;

    /**
     * @param \Plumrocket\Base\Model\Extension\GetModuleName $getModuleName
     */
    public function __construct(GetModuleName $getModuleName)
    {
        $this->getModuleName = $getModuleName;
    }

    public function execute(string $moduleName): array
    {
        $moduleName = $this->getModuleName->execute($moduleName);

        $xmlPath = 'https://' . Urls::VERSIONS_URL;
        $message = '';
        $version = '';

        try {
            $context = stream_context_create(
                [
                    'http' => [
                        'timeout'       => 2,
                        'ignore_errors' => true,
                    ],
                ]
            );
            $string = file_get_contents($xmlPath, false, $context);

            if ($string && $moduleName) {
                $xml = simplexml_load_string($string);
                if ($xml && isset($xml->Magento2->{$moduleName})) {
                    $extData = $xml->Magento2->{$moduleName} ?? null;

                    if ($extData !== null && isset($extData->message, $extData->version)) {
                        $message = (string)$extData->message;
                        $version = (string)$extData->version;
                    }
                }
            }
        } catch (\Exception $e) {}

        return ['message' => $message, 'newv' => $version];
    }
}
