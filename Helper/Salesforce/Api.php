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
use Magento\Framework\HTTP\Client\Curl;

class Api
{
    const AUTH_URL = 'https://login.salesforce.com/services/oauth2/token';
    const DEFAULT_API_PATH = '/services/data/v53.0';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $instanceUrl;

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @param Curl $curl
     */
    public function __construct(
        Curl $curl
    )
    {
        $this->curl = $curl;
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->curl->setOption(CURLOPT_FOLLOWLOCATION, true);
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return Api
     */
    public function setClientId(string $clientId): Api
    {
        $this->clientId = $clientId;
        return $this;

    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return Api
     */
    public function setClientSecret(string $clientSecret): Api
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Api
     */
    public function setUsername(string $username): Api
    {
        $this->username = $username;
        return $this;

    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Api
     */
    public function setPassword(string $password): Api
    {
        $this->password = $password;
        return $this;

    }

    /**
     * @return Api
     * @throws Exception
     */
    public function auth(): Api
    {
        $postFields = [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $this->username,
            'password' => $this->password,
        ];
        $this->curl->setHeaders(['Content-Type' => 'application/x-www-form-urlencoded']);
        $this->curl->post(self::AUTH_URL, $postFields);
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            throw new Exception(__('Unexpected error'));
        }
        if (!isset($response['access_token'], $response['instance_url'])) {
            $message = __('An authentication error occurred.');
            $message .= ' response:' . json_encode($response);
            throw new Exception($message);
        }
        $this->accessToken = $response['access_token'];
        $this->instanceUrl = $response['instance_url'];
        $this->apiUrl      = $this->instanceUrl . $this->getApiPath();
        return $this;
    }

    /**
     * @return string
     * @throws Exception
     */
    private function getApiPath(): string
    {
        $this->curl->setHeaders(['Authorization' => 'Bearer ' . $this->accessToken]);
        $this->curl->get($this->instanceUrl . '/services/data');
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            throw new Exception(__('Unexpected error'));
        }
        $apiUrl = null;
        foreach ($response as $item) {
            if (isset($item['version'], $item['url']) && $item['version'] == "53.0") {
                $apiUrl = $item['url'];
                break;
            }
        }
        if (!$apiUrl) {
            $item = end($response);
            if (isset($item['version'], $item['url'])) {
                $apiUrl = $item['url'];
            }
        }
        return $apiUrl ?? self::DEFAULT_API_PATH;
    }

    /**
     * @param array $lead
     * @return string
     * @throws Exception
     */
    public function addLead(array $lead): string
    {
        $this->curl->setHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken
        ]);
        $this->curl->post($this->apiUrl . '/sobjects/lead', json_encode($lead));
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            throw new Exception(__('Unexpected error'));
        }
        if (isset($response['errorCode'], $response['message'])) {
            if ($response['errorCode'] == 'DUPLICATES_DETECTED') {
                throw new Exception(__('Lead already exists.'));
            }
            throw new Exception(__($response['message']));
        }
        if (!isset($response['success'], $response['id']) || !$response['success']) {
            if (!empty($response['errors'])) {
                throw new Exception(json_encode($response['errors']));
            }
            throw new Exception(json_encode($response));
        }
        return $response['id'];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getLeadFields(): array
    {
        $this->curl->setHeaders(['Authorization' => 'Bearer ' . $this->accessToken]);
        $this->curl->get($this->apiUrl . '/sobjects/lead/describe');
        $response = json_decode($this->curl->getBody(), true);
        if (!is_array($response)) {
            throw new Exception(__('Unexpected error'));
        }
        if (isset($response['errorCode'], $response['message'])) {
            throw new Exception(__($response['message']));
        }
        return $response['fields'] ?? [];
    }

    /**
     * @param string $leadId
     * @param string $campaignId
     * @param string $status
     * @return string
     * @throws Exception
     */
    public function addCampaignMember(string $leadId, string $campaignId, string $status = 'Responded'): string
    {
        $campaignMember = [
            'LeadId' => $leadId,
            'CampaignId' => $campaignId,
            'Status' => $status
        ];

        $this->curl->setHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken
        ]);
        $this->curl->post($this->apiUrl . '/sobjects/CampaignMember', json_encode($campaignMember));
        $response = json_decode($this->curl->getBody(), true);

        if (!is_array($response)) {
            throw new Exception(__('Unexpected error'));
        }
        if (isset($response['errorCode'], $response['message'])) {
            throw new Exception(__($response['message']));
        }
        if (!isset($response['success'], $response['id']) || !$response['success']) {
            throw new Exception(json_encode($response));
        }
        return $response['id'];
    }
}