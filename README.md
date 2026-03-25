# MageMe WebForms 3 — Salesforce Integration

Free add-on for [MageMe WebForms for Magento 2](https://mageme.com/magento-2-form-builder.html) that integrates form submissions with Salesforce CRM.

## Features

- Automatically create Salesforce leads from form submissions
- Map form fields to Salesforce lead object properties
- Send submissions to Salesforce manually from the admin panel

## Requirements

- Magento 2.4.x
- [MageMe WebForms 3](https://mageme.com/magento-2-form-builder.html) version 3.5.0 or higher
- PHP `curl` and `json` extensions

## Installation

### Via Composer

```
composer require mageme/module-webforms-3-salesforce
bin/magento setup:upgrade
bin/magento cache:flush
```

### Manual Installation

1. Download and extract to `app/code/MageMe/WebFormsSalesforce/`
2. Run `bin/magento setup:upgrade`
3. Run `bin/magento cache:flush`

## Configuration

1. Navigate to **Stores > Configuration > MageMe > WebForms > Salesforce** and enter your Salesforce credentials (Client ID, Client Secret, Security Token).
2. Open a form in the admin panel and configure the Salesforce integration tab to map form fields to lead properties.

## About MageMe WebForms

[MageMe WebForms](https://mageme.com/magento-2-form-builder.html) is a powerful form builder for Magento 2 that allows you to create any type of form — contact forms, surveys, registration forms, order forms, and more — with a drag-and-drop interface, conditional logic, file uploads, and CRM integrations.

[Get MageMe WebForms](https://mageme.com/magento-2-form-builder.html)

## Support

- Documentation: [docs.mageme.com](https://docs.mageme.com)
- Issue Tracker: [GitHub Issues](https://github.com/mageme/module-webforms-3-salesforce/issues)

## License

Proprietary. See [License](https://mageme.com/license/) for details.
