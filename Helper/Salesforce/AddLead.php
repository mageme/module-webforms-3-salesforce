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

namespace MageMe\WebFormsSalesforce\Helper\Salesforce;

use Exception;
use InvalidArgumentException;
use MageMe\WebForms\Api\Data\FieldInterface;
use MageMe\WebForms\Api\Data\FormInterface;
use MageMe\WebForms\Api\Data\ResultInterface;
use MageMe\WebForms\Api\FieldRepositoryInterface;
use MageMe\WebFormsSalesforce\Helper\SalesforceHelper;
use MageMe\WebFormsSalesforce\Ui\Component\Form\Form\Modifier\SalesforceIntegrationSettings;
use Magento\Framework\Exception\NoSuchEntityException;

class AddLead
{
    /**
     * @var SalesforceHelper
     */
    private $salesforceHelper;
    /**
     * @var FieldRepositoryInterface
     */
    private $fieldRepository;

    /**
     * @param FieldRepositoryInterface $fieldRepository
     * @param SalesforceHelper $salesforceHelper
     */
    public function __construct(FieldRepositoryInterface $fieldRepository, SalesforceHelper $salesforceHelper)
    {
        $this->salesforceHelper = $salesforceHelper;
        $this->fieldRepository  = $fieldRepository;
    }

    /**
     * @param ResultInterface $result
     * @return void
     * @throws NoSuchEntityException
     * @throws Exception
     */
    public function execute(ResultInterface $result)
    {
        $form  = $result->getForm();
        $email = $this->getEmail($form, $result);
        if (!$email) {
            throw new InvalidArgumentException(__('No email'));
        }
        $firstName = '';
        $lastName  = $result->getCustomerName();
        $customer  = $result->getCustomer();
        if ($customer) {
            $firstName = $customer->getFirstname();
            $lastName  = $customer->getLastname();
        }
        $contact   = [
            'LastName'  => $lastName,
            'FirstName' => $firstName,
            'Email'     => $email,
            'Company'   => '-'
        ];
        $mapFields = $this->mapFields($form, $result);
        $contact   = array_merge($contact, $mapFields);
        $api       = $this->salesforceHelper->getApi();
        $leadId    = $api->addLead($contact);

        $campaignField = $form->getFieldByCode('campaignId');
        $statusField   = $form->getFieldByCode('status');
        if ($campaignField) {
            $api->addCampaignMember($leadId, $campaignField->getValue(), $statusField ? $statusField->getValue() : null);
        }
    }

    /**
     * @param FormInterface|\MageMe\WebFormsSalesforce\Api\Data\FormInterface $form
     * @param ResultInterface $result
     * @return string
     */
    protected function getEmail(FormInterface $form, ResultInterface $result): string
    {
        $values  = $result->getFieldArray();
        $emailId = $form->getSalesforceEmailFieldId();
        $email   = $values[$emailId] ?? '';
        if ($email) {
            return $email;
        }
        $emailList = $result->getCustomerEmail();
        return $emailList[0] ?? '';
    }

    /**
     * @param FormInterface|\MageMe\WebFormsSalesforce\Api\Data\FormInterface $form
     * @param ResultInterface $result
     * @return array
     * @throws NoSuchEntityException
     */
    protected function mapFields(FormInterface $form, ResultInterface $result): array
    {
        $contact   = [];
        $values    = $result->getFieldArray();
        $mapFields = $form->getSalesforceMapFields();
        foreach ($mapFields as $mapField) {
            if (empty($values[$mapField[FieldInterface::ID]])) {
                continue;
            }
            $value                                                                  = $this->fieldRepository->getById((int)$mapField[FieldInterface::ID])
                ->getValueForResultTemplate($values[$mapField[FieldInterface::ID]], $result->getId(), ['date_format' => 'yyyy-MM-dd']);
            $contact[$mapField[SalesforceIntegrationSettings::SALESFORCE_FIELD_ID]] = $value;
        }
        return $contact;
    }
}