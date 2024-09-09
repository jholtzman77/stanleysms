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

namespace Plumrocket\Base\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Provides methods for work with config value
 *
 * Generally we create const like this:
 *     public const XML_PATH_IS_ENABLED = 'pr_base/general/enabled';
 *
 * @since 2.3.1
 */
class ConfigUtils extends AbstractHelper
{
    /**
     * Receive magento config value
     *
     * @param string      $path full path, eg: "pr_base/general/enabled"
     * @param string|int  $scopeCode store view code or website code
     * @param string|null $scopeType
     * @return mixed
     */
    public function getConfig($path, $scopeCode = null, $scopeType = null)
    {
        if ($scopeType === null) {
            $scopeType = ScopeInterface::SCOPE_STORE;
        }
        return $this->scopeConfig->getValue($path, $scopeType, $scopeCode);
    }

    /**
     * @param $fieldValue
     * @return array
     */
    protected function splitTextareaValueByLine($fieldValue): array
    {
        $lines = explode(PHP_EOL, $fieldValue);

        if (empty($lines)) {
            return [];
        }

        return array_filter(array_map('trim', $lines));
    }

    /**
     * @param string $value
     * @param bool   $clearEmpty
     * @return array
     */
    protected function prepareMultiselectValue(string $value, bool $clearEmpty = true): array
    {
        $values = explode(',', $value);
        return $clearEmpty ? array_filter($values) : $values;
    }
}
