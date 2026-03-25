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

namespace MageMe\WebFormsSalesforce\Api\Data;

interface FormInterface extends \MageMe\WebForms\Api\Data\FormInterface
{
    /** Salesforce settings */
    const IS_SALESFORCE_ENABLED = 'is_salesforce_enabled';
    const SALESFORCE_EMAIL_FIELD_ID = 'salesforce_email_field_id';
    const SALESFORCE_MAP_FIELDS_SERIALIZED = 'salesforce_map_fields_serialized';

    /**
     * Additional constants for keys of data array.
     */
    const SALESFORCE_MAP_FIELDS = 'salesforce_map_fields';

    #region Salesforce
    /**
     * Get isSalesforceEnabled
     *
     * @return bool
     */
    public function getIsSalesforceEnabled(): bool;

    /**
     * Set isSalesforceEnabled
     *
     * @param bool $isSalesforceEnabled
     * @return $this
     */
    public function setIsSalesforceEnabled(bool $isSalesforceEnabled): FormInterface;

    /**
     * Get salesforceEmailFieldId
     *
     * @return int|null
     */
    public function getSalesforceEmailFieldId(): ?int;

    /**
     * Set salesforceEmailFieldId
     *
     * @param int|null $salesforceEmailFieldId
     * @return $this
     */
    public function setSalesforceEmailFieldId(?int $salesforceEmailFieldId): FormInterface;

    /**
     * Get salesforceMapFieldsSerialized
     *
     * @return string|null
     */
    public function getSalesforceMapFieldsSerialized(): ?string;

    /**
     * Set salesforceMapFieldsSerialized
     *
     * @param string $salesforceMapFieldsSerialized
     * @return $this
     */
    public function setSalesforceMapFieldsSerialized(string $salesforceMapFieldsSerialized): FormInterface;

    /**
     * Get salesforceMapFields
     *
     * @return array
     */
    public function getSalesforceMapFields(): array;

    /**
     * Set salesforceMapFields
     *
     * @param array $salesforceMapFields
     * @return $this
     */
    public function setSalesforceMapFields(array $salesforceMapFields): FormInterface;
    #endregion
}
