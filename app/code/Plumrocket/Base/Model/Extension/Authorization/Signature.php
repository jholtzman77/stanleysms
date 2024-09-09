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

namespace Plumrocket\Base\Model\Extension\Authorization;

use Magento\Framework\Encryption\Encryptor;

/**
 * @since 2.5.0
 */
class Signature
{
    /**
     * @var \Plumrocket\Base\Model\Extension\Authorization\Key
     */
    private $key;

    /**
     * @var \Magento\Framework\Encryption\Encryptor
     */
    private $encryptor;

    /**
     * @param \Plumrocket\Base\Model\Extension\Authorization\Key $key
     * @param \Magento\Framework\Encryption\Encryptor            $encryptor
     */
    public function __construct(Key $key, Encryptor $encryptor)
    {
        $this->key = $key;
        $this->encryptor = $encryptor;
    }

    /**
     * @param string $moduleName
     * @return string
     */
    public function create(string $moduleName): string
    {
        return $this->encryptor->hash(
            $moduleName . $this->key->get($moduleName),
            Encryptor::HASH_VERSION_MD5
        );
    }
}
