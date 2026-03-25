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

namespace MageMe\WebFormsSalesforce\Plugin\Helper\Result\PostHelper;

use Exception;
use MageMe\WebForms\Api\Data\FormInterface;
use MageMe\WebForms\Api\Data\ResultInterface;
use MageMe\WebForms\Helper\Result\PostHelper;
use MageMe\WebFormsSalesforce\Helper\Salesforce\AddLead;

class PostResult
{
    /**
     * @var AddLead
     */
    private $addLead;

    /**
     * @param AddLead $addLead
     */
    public function __construct(AddLead $addLead)
    {
        $this->addLead = $addLead;
    }

    /**
     * @param PostHelper $postHelper
     * @param array $data
     * @param FormInterface $form
     * @param array $config
     * @return array
     * @noinspection PhpUnusedParameterInspection
     */
    public function afterPostResult(PostHelper $postHelper, array $data, FormInterface $form, array $config = []): array
    {
        if (!$data['success'] || !($data['model'] instanceof ResultInterface)) {
            return $data;
        }
        $result = $data['model'];
        try {
            $this->addLead->execute($result);
        } catch (Exception $e) {
        }
        return $data;
    }

}