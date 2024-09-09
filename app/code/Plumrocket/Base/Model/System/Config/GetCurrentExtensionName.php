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

namespace Plumrocket\Base\Model\System\Config;

use Magento\Framework\Exception\NotFoundException;

/**
 * @since 2.5.0
 */
class GetCurrentExtensionName
{
    /**
     * @var \Plumrocket\Base\Model\System\Config\CurrentSection
     */
    private $currentSection;

    /**
     * @param \Plumrocket\Base\Model\System\Config\CurrentSection $currentSection
     */
    public function __construct(CurrentSection $currentSection)
    {
        $this->currentSection = $currentSection;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute(): string
    {
        if ($section = $this->currentSection->get()) {
            /** @var \Magento\Config\Model\Config\Structure\Element\Group $group */
            foreach ($section->getChildren() as $group) {
                if ($group->getId() !== 'general') {
                    continue;
                }
                /** @var \Magento\Config\Model\Config\Structure\Element\Field $field */
                foreach ($group->getChildren() as $field) {
                    if ($field->getId() !== 'version') {
                        continue;
                    }

                    // TODO: remove after changing system config in all modules
                    if (! $field->getAttribute('pr_extension_name')) {
                        $versionFiledData = $field->getData();
                        return explode('\\', $versionFiledData['frontend_model'])[1];
                    }

                    return $field->getAttribute('pr_extension_name');
                }
            }

            throw new NotFoundException(__('Not found version field'));
        }

        throw new NotFoundException(__('Not found section'));
    }
}
