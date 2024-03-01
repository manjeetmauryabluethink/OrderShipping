<?php
 
namespace Bluethinkinc\Order\Plugin\Checkout\Model;
 
class LayoutProcessor
{
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['custom_tax'] = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'custom_tax',
            ],
            'dataScope' => 'shippingAddress.custom_tax',
            'label' => 'Custom Tax',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [
                'required-entry'=> true
            ],
            'sortOrder' => 251,
            'id' => 'custom_tax',
            'options' => [
                [
                    'value' => '',
                    'label' => 'Please Select',
                ],
                [
                    'value' => '8',
                    'label' => '8%',
                ],
                [
                    'value' => '9',
                    'label' => '9%',
                ],
                [
                    'value' => '10',
                    'label' => '10%',
                ]
            ]
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['fixed_country'] = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'fixed_country',
            ],
            'dataScope' => 'shippingAddress.fixed_country',
            'label' => 'Fixed Country',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [
                'required-entry'=> true
            ],
            'sortOrder' => 251,
            'id' => 'fixed_country',
            'options' => [
                [
                    'value' => '',
                    'label' => 'Please Select',
                ],
                [
                    'value' => 'saf',
                    'label' => 'South Africa',
                ],
                [
                    'value' => 'russia',
                    'label' => 'Russia',
                ],
                [
                    'value' => 'singapore',
                    'label' => 'Singapore',
                ]
            ]
        ];

        return $jsLayout;
    }
}