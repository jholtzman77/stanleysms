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

namespace Plumrocket\Base\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Plumrocket\Base\Model\Theme\GetInformation;

/**
 * @since 2.3.5
 */
class AddThemeHandleObserver implements ObserverInterface
{
    const LAYOUT_PREFIX = 'pl_thm_';

    /**
     * @var \Plumrocket\Base\Model\Theme\GetInformation
     */
    private $getThemeInformation;

    /**
     * @param \Plumrocket\Base\Model\Theme\GetInformation $getThemeInformation
     */
    public function __construct(GetInformation $getThemeInformation)
    {
        $this->getThemeInformation = $getThemeInformation;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\View\Layout\ProcessorInterface $update */
        $update = $observer->getEvent()->getLayout()->getUpdate();
        $update->addHandle($this->createLayoutName($this->getThemeInformation->getVendor()));
        $update->addHandle($this->createLayoutName($this->getThemeInformation->getName()));
    }

    /**
     * @param string $string
     * @return string
     */
    private function createLayoutName(string $string): string
    {
        return self::LAYOUT_PREFIX . str_replace('-', '_', $string) . '_default';
    }
}
