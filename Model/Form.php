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

namespace MageMe\WebFormsSalesforce\Model;

use MageMe\WebFormsSalesforce\Api\Data\FormInterface;

class Form extends \MageMe\WebForms\Model\Form implements FormInterface
{
    #region DB getters and setters
    /**
     * @inheritDoc
     */
    public function getIsSalesforceEnabled(): bool
    {
        return (bool)$this->getData(self::IS_SALESFORCE_ENABLED);
    }

    /**
     * @inheritDoc
     */
    public function setIsSalesforceEnabled(bool $isSalesforceEnabled): FormInterface
    {
        return $this->setData(self::IS_SALESFORCE_ENABLED, $isSalesforceEnabled);
    }

    /**
     * @inheritDoc
     */
    public function getSalesforceEmailFieldId(): ?int
    {
        return $this->getData(self::SALESFORCE_EMAIL_FIELD_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSalesforceEmailFieldId(?int $salesforceEmailFieldId): FormInterface
    {
        return $this->setData(self::SALESFORCE_EMAIL_FIELD_ID, $salesforceEmailFieldId);
    }

    /**
     * @inheritDoc
     */
    public function getSalesforceMapFieldsSerialized(): ?string
    {
        return $this->getData(self::SALESFORCE_MAP_FIELDS_SERIALIZED);
    }

    /**
     * @inheritDoc
     */
    public function setSalesforceMapFieldsSerialized(string $salesforceMapFieldsSerialized): FormInterface
    {
        return $this->setData(self::SALESFORCE_MAP_FIELDS_SERIALIZED, $salesforceMapFieldsSerialized);
    }

    /**
     * @inheritDoc
     */
    public function getSalesforceMapFields(): array
    {
        $data = $this->getData(self::SALESFORCE_MAP_FIELDS);
        return is_array($data) ? $data : [];
    }

    /**
     * @inheritDoc
     */
    public function setSalesforceMapFields(array $salesforceMapFields): FormInterface
    {
        return $this->setData(self::SALESFORCE_MAP_FIELDS, $salesforceMapFields);
    }
    #endregion
}
