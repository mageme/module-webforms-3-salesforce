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

namespace MageMe\WebFormsSalesforce\Helper;

use Exception;
use InvalidArgumentException;
use MageMe\WebFormsSalesforce\Helper\Salesforce\Api;
use Magento\Framework\App\Config\ScopeConfigInterface;

class SalesforceHelper
{
    const CONFIG_CLIENT_ID = 'webforms/salesforce/client_id';
    const CONFIG_CLIENT_SECRET = 'webforms/salesforce/client_secret';
    const CONFIG_USERNAME = 'webforms/salesforce/username';
    const CONFIG_PASSWORD = 'webforms/salesforce/password';

    /**
     * @var Api
     */
    private $api;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param Api $api
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Api                  $api,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->api         = $api
            ->setClientId($this->getConfigClientId())
            ->setClientSecret($this->getConfigClientSecret())
            ->setUsername($this->getConfigUsername())
            ->setPassword($this->getConfigPassword());
    }

    /**
     * @return string
     */
    protected function getConfigClientId(): string
    {
        return (string)$this->scopeConfig->getValue(self::CONFIG_CLIENT_ID);
    }

    /**
     * @return string
     */
    protected function getConfigClientSecret(): string
    {
        return (string)$this->scopeConfig->getValue(self::CONFIG_CLIENT_SECRET);
    }

    /**
     * @return string
     */
    protected function getConfigUsername(): string
    {
        return (string)$this->scopeConfig->getValue(self::CONFIG_USERNAME);
    }

    /**
     * @return string
     */
    protected function getConfigPassword(): string
    {
        return (string)$this->scopeConfig->getValue(self::CONFIG_PASSWORD);
    }

    /**
     * @return Api
     * @throws Exception
     */
    public function getApi(): ?Api
    {
        $this->validateConfig();
        return $this->api->auth();
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function validateConfig()
    {
        if (empty($this->getConfigClientId())) {
            throw new InvalidArgumentException(__('Salesforce consumer key not configured.'));
        }
        if (empty($this->getConfigClientSecret())) {
            throw new InvalidArgumentException(__('Salesforce consumer secret not configured.'));
        }
        if (empty($this->getConfigUsername())) {
            throw new InvalidArgumentException(__('Salesforce username not configured.'));
        }
        if (empty($this->getConfigPassword())) {
            throw new InvalidArgumentException(__('Salesforce password not configured.'));
        }
    }
}
