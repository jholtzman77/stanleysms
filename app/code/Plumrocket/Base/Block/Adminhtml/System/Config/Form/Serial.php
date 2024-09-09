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

namespace Plumrocket\Base\Block\Adminhtml\System\Config\Form;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\NoSuchEntityException;
use Plumrocket\Base\Api\ExtensionAuthorizationRepositoryInterface;
use Plumrocket\Base\Model\Extension\Authorization\Factory;
use Plumrocket\Base\Model\Extension\Authorization\Key;
use Plumrocket\Base\Model\IsModuleInMarketplace;

/**
 * @since 1.0.0
 */
class Serial extends Field
{
    /**
     * @var \Plumrocket\Base\Model\IsModuleInMarketplace
     */
    private $isModuleInMarketplace;

    /**
     * @var \Plumrocket\Base\Api\ExtensionAuthorizationRepositoryInterface
     */
    private $extensionAuthorizationRepository;

    /**
     * @var \Plumrocket\Base\Model\Extension\Authorization\Key
     */
    private $authorizationKey;

    /**
     * @var \Plumrocket\Base\Model\Extension\Authorization\Factory
     */
    private $extensionAuthorizationFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context                        $context
     * @param \Plumrocket\Base\Model\IsModuleInMarketplace                   $isModuleInMarketplace
     * @param \Plumrocket\Base\Api\ExtensionAuthorizationRepositoryInterface $extensionAuthorizationRepository
     * @param \Plumrocket\Base\Model\Extension\Authorization\Key             $authorizationKey
     * @param \Plumrocket\Base\Model\Extension\Authorization\Factory         $extensionAuthorizationFactory
     * @param array                                                          $data
     */
    public function __construct(
        Context $context,
        IsModuleInMarketplace $isModuleInMarketplace,
        ExtensionAuthorizationRepositoryInterface $extensionAuthorizationRepository,
        Key $authorizationKey,
        Factory $extensionAuthorizationFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->isModuleInMarketplace = $isModuleInMarketplace;
        $this->extensionAuthorizationRepository = $extensionAuthorizationRepository;
        $this->authorizationKey = $authorizationKey;
        $this->extensionAuthorizationFactory = $extensionAuthorizationFactory;
    }

    /**
     * Render element value
     *
     * @param  \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _renderValue(AbstractElement $element)
    {
        $html = '<td class="value with-tooltip">';
        $html .= $this->_getElementHtml($element);

        $moduleName = $this->getModuleNameFromElement($element);

        try {
            $authorization = $this->extensionAuthorizationRepository->get($moduleName);
        } catch (NoSuchEntityException $e) {
            $authorization =  $this->extensionAuthorizationFactory->create($moduleName);
        }
        if ($this->authorizationKey->get($moduleName)) {
            if ($authorization->isAuthorized()) {
                $title = 'Thank you! Your serial key is accepted. You can start using extension.';
                $icon = $this->getViewFileUrl('Plumrocket_Base::images/success_msg_icon.gif');
                $html .= '<div class="tooltip">' .
                    "<span><span><img src=\"{$icon}\" style=\"margin-top: 2px;float: right;\" /></span></span>";
                $html .= '<div class="tooltip-content">' . $title . '</div></div>';
            } else {
                $icon = $this->getViewFileUrl('Plumrocket_Base::images/error_msg_icon.gif');
                $html .= '<div class="tooltip">' .
                    '<span><span><img src="'.$icon.'" style="margin-top: 2px;float: right;" /></span></span>' .
                    '</div>';
            }
        }

        if ($this->isModuleInMarketplace->execute($moduleName)) {
            $html .= '<p class="note">' .
                '<span>You can find Serial Key in your Plumrocket Store account. ' .
                'If you have any questions, please contact us at ' .
                '<a href="mailto:support@plumrocket.com">support@plumrocket.com</a>.</span></p>';
        } else {
            $html .= '<p class="note"><span>You can find <strong>Serial Key</strong> in your account at ' .
                '<a target="_blank" href="https://store.plumrocket.com/downloadable/customer/products/">' .
                'store.plumrocket.com' .
                '</a>. For manual ' .
                '<a target="_blank" href="http://wiki.plumrocket.com/wiki/Magento_2_License_Installation">' .
                'click here</a>.</span></p>';
        }

        $html .= '</td>';
        return $html;
    }

    /**
     * Retrieve HTML markup for given form element
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $fields = [
            'plumbase_order_id' => __('Marketplace Order ID'),
            'plumbase_account_email' => __('Marketplace Account Email')
        ];

        $moduleName = $this->getModuleNameFromElement($element);
        $hideMarketplaceFields = ! $this->isModuleInMarketplace->execute($moduleName) ? 'style="display:none;"' : '';
        $marketplaceFields = '';

        if ($this->isModuleInMarketplace->execute($moduleName)) {
            $commentText = __(
                'You can find Marketplace Order ID and Email in your Magento Marketplace Account. ' .
                'If you have any questions, please contact us at ' .
                '<a href="mailto:support@plumrocket.com">support@plumrocket.com</a>'
            );
        } else {
            $commentText = __(
                'You can find Marketplace Order ID and Email in your Magento Marketplace Account. ' .
                'For manual <a target="_blank" href="%1">click here</a>.',
                'http://wiki.plumrocket.com/License_Installation_For_Magento_2_Marketplace_Customers'
            );
        }

        foreach ($fields as $key => $value) {
            $comment = ($key === 'plumbase_account_email') ? '<p class="note">
                <span>' . $commentText . '</span></p>' : '';

            $marketplaceFields .= '
                <tr ' . $hideMarketplaceFields . ' id="row_'. $key . '">
                    <td class="label">
                        <label for="' . $key . '">' . $value . '</label>
                    </td>
                    <td class="value">
                          <input id="' . $key . '" class="input-text" type="text"/>
                          ' . $comment . '
                    </td>
                </tr>
            ';
        }

        $marketplaceFields .= '
            <tr ' . $hideMarketplaceFields . '>
                 <td class="label"></td>
                 <td class="value">
                      <button id="plumbase_activate_extension"
                              title="' . __("Activate Extension") . '"
                              type="button"
                              class="scalable"
                              onclick="false;">
                           <span>
                               <span>
                                    <span> ' . __("Activate Extension") . '</span>
                               </span>
                           </span>
                      </button>
                 </td>
            </tr>
        ';

        $serialKeyHtml = parent::render($element);
        $value = (string) $element->getValue();

        if (empty($value) && $this->isModuleInMarketplace->execute($moduleName)) {
            $serialKeyHtml = str_replace("<tr", "<tr style='display:none;'", $serialKeyHtml)
                . $marketplaceFields . $this->_js($element->getHtmlId(), $moduleName);
        }

        return $serialKeyHtml;
    }

    private function _js($serialKeyId, $moduleName)
    {
        return "
            <script type='text/javascript'>
                require([
                    'jquery',
                    'mage/translate',
                    'mage/storage',
                    'Magento_Ui/js/modal/alert',
                    'domReady!'
                ], function ($, __, storage, alert) {
                    var button = $('#plumbase_activate_extension'),
                    orderId = $('#plumbase_order_id'),
                    accountEmail = $('#plumbase_account_email'),
                    serialKey = $('#" . $serialKeyId . "'),
                    messageBlock = $(\".page-main-actions\"),
                    plumbaseMessageBlockEl;

                    button.on('click', function(el) {
                        jQuery('body').loader('show');
                        $.ajax({
                           type: 'POST',
                           url: '" . $this->getUrl('plumbase/call') . "',
                           data: {
                              order_id :orderId.val(),
                              account_email :accountEmail.val(),
                              module :'" . $moduleName . "'
                           },
                           success: function(response) {
                                var json = JSON.parse(response);

                                if (typeof json.data != \"undefined\") {
                                    serialKey.val(json.data);
                                }

                                if (typeof json.error != \"undefined\") {
                                    var plbMessage = '<div id=\'plumbaseMessageBlockError\' class=\'message message-error error\'><div data-ui-id=\'messages-message-error\'>'
                                        + json.error
                                        + '</div></div><br/>';

                                    plumbaseMessageBlockEl = $(\"#plumbaseMessageBlockError\");

                                    if (plumbaseMessageBlockEl.length > 0) {
                                        plumbaseMessageBlockEl.html(json.error);
                                    } else if (messageBlock.length > 0) {
                                        messageBlock.after(plbMessage);
                                    }
                                } else {
                                    plumbaseMessageBlockEl = $(\"#plumbaseMessageBlockError\");
                                    if (plumbaseMessageBlockEl.length > 0) {
                                        plumbaseMessageBlockEl.hide();
                                    }
                                }

                                if (json.hash) {
                                    serialKey.parents('tr').show();
                                    button.parents('tr').hide();
                                    orderId.parents('tr').hide();
                                    accountEmail.parents('tr').hide();
                                }

                                jQuery('body').loader('hide');
                           }
                        });
                    });
                });
            </script>
        ";
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return array|mixed|string
     */
    public function getModuleNameFromElement(AbstractElement $element)
    {
        return $element->getData('field_config/pr_extension_name') ?: $element->getHint()->getText();
    }
}
