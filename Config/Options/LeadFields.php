<?php
/**
 * MageMe
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MageMe.com license that is
 * available through the world-wide-web at this URL:
 * https://mageme.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to a newer
 * version in the future.
 *
 * Copyright (c) MageMe (https://mageme.com)
 **/

namespace MageMe\WebFormsSalesforce\Config\Options;

use Exception;
use MageMe\WebFormsSalesforce\Helper\SalesforceHelper;
use Magento\Framework\Data\OptionSourceInterface;

class LeadFields implements OptionSourceInterface
{
    /**
     * @var array
     */
    private $options;
    /**
     * @var SalesforceHelper
     */
    private $salesforceHelper;

    /**
     * @param SalesforceHelper $salesforceHelper
     */
    public function __construct(SalesforceHelper $salesforceHelper)
    {
        $this->salesforceHelper = $salesforceHelper;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        if ($this->options) {
            return $this->options;
        }
        try {
            $leadFields    = $this->salesforceHelper->getApi()->getLeadFields();
            $customOptions = [];
            foreach ($leadFields as $leadField) {
                if ($leadField['custom']) {
                    $customOptions[] = [
                        'label' => __($leadField['label']),
                        'value' => $leadField['name']
                    ];
                }
            }
            $this->options   = $this->getDefaultOptions();
            $this->options[] = [
                'label' => __('Custom Fields'),
                'value' => $customOptions,
            ];
        } catch (Exception $exception) {
            return $this->getDefaultOptions();
        }
        return $this->options;
    }

    /**
     * @return array
     */
    private function getDefaultOptions(): array
    {
        return [
            [
                'label' => __('Name'),
                'value' => [
                    [
                        'label' => __('Salutation'),
                        'value' => 'Salutation'
                    ],
                    [
                        'label' => __('First Name'),
                        'value' => 'FirstName'
                    ],
                    [
                        'label' => __('Last Name'),
                        'value' => 'LastName'
                    ],
                ],
            ],
            ['label' => __('Company'),
                'value' => 'Company'
            ],
            [
                'label' => __('Website'),
                'value' => 'Website'
            ],
            [
                'label' => __('Title'),
                'value' => 'Title'
            ],
            [
                'label' => __('Lead Source'),
                'value' => 'LeadSource'
            ],
            [
                'label' => __('Phone'),
                'value' => 'Phone'
            ],
            [
                'label' => __('Mobile'),
                'value' => 'MobilePhone'
            ],
            [
                'label' => __('Fax'),
                'value' => 'Fax'
            ],
            [
                'label' => __('Annual Revenue'),
                'value' => 'AnnualRevenue'
            ],
            [
                'label' => __('No. of Employees'),
                'value' => 'NumberOfEmployees'
            ],
            [
                'label' => __('Address'),
                'value' => [
                    [
                        'label' => __('Street'),
                        'value' => 'Street'
                    ],
                    [
                        'label' => __('City'),
                        'value' => 'City'
                    ],
                    [
                        'label' => __('State/Province'),
                        'value' => 'State'
                    ],
                    [
                        'label' => __('Zip/Postal Code'),
                        'value' => 'PostalCode'
                    ],
                    [
                        'label' => __('Country'),
                        'value' => 'Country'
                    ],
                ]
            ],
        ];
    }
}