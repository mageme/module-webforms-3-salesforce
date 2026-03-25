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

namespace MageMe\WebFormsSalesforce\Observer;

use Exception;
use MageMe\WebForms\Api\Data\FieldInterface;
use MageMe\WebForms\Api\FormRepositoryInterface;
use MageMe\WebFormsSalesforce\Api\Data\FormInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class WebformsFormImportObserver implements ObserverInterface
{
    /**
     * @var FormRepositoryInterface
     */
    private $formRepository;

    /**
     * @param FormRepositoryInterface $formRepository
     */
    public function __construct(
        FormRepositoryInterface $formRepository
    )
    {
        $this->formRepository = $formRepository;
    }

    /**
     * @param Observer $observer
     * @throws Exception
     */
    public function execute(Observer $observer)
    {
        /** @var FormInterface $form */
        $form          = $observer->getData('form');
        $elementMatrix = $observer->getData('elementMatrix');

        $oldId = $form->getSalesforceEmailFieldId();
        if ($oldId && !empty($elementMatrix['field_' . $oldId])) {
            $form->setSalesforceEmailFieldId($elementMatrix['field_' . $oldId]);
        }
        $serializedFields = $form->getSalesforceMapFieldsSerialized();
        if ($serializedFields) {
            $map = json_decode($serializedFields, true);
            if (is_array($map)) {
                foreach ($map as &$mapField) {
                    if (!empty($mapField[FieldInterface::ID]) &&
                        !empty($elementMatrix['field_' . $mapField[FieldInterface::ID]])) {
                        $mapField[FieldInterface::ID] = $elementMatrix['field_' . $mapField[FieldInterface::ID]];
                    }
                }
            }
            $form->setSalesforceMapFields($map);
        }
        $this->formRepository->save($form);
    }
}
