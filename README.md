# Magento 2 Salesforce Integration — MageMe WebForms

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mageme/module-webforms-3-salesforce.svg)](https://packagist.org/packages/mageme/module-webforms-3-salesforce)
[![Packagist Downloads](https://img.shields.io/packagist/dt/mageme/module-webforms-3-salesforce.svg)](https://packagist.org/packages/mageme/module-webforms-3-salesforce)
[![License](https://img.shields.io/packagist/l/mageme/module-webforms-3-salesforce.svg)](https://mageme.com/license/)

Turn Magento 2 form submissions into Salesforce leads. This free add-on for [MageMe WebForms](https://mageme.com/magento-2-form-builder.html) pushes form data to Salesforce CRM via the REST API with OAuth 2.0 authentication, custom field mapping, and campaign membership tracking.

## Features

- Create Salesforce leads automatically from form submissions
- Authenticate via OAuth 2.0 with automatic token refresh
- Map form fields to any standard or custom Salesforce lead field
- Associate leads with Salesforce campaigns and set campaign member status
- Automatic date format conversion and number field sanitization
- Auto-populate FirstName, LastName, Email, and Company from form data
- Resend submissions to Salesforce manually from the Magento admin panel

## Requirements

- Magento 2.4.x
- [MageMe WebForms 3](https://mageme.com/magento-2-form-builder.html) version 3.5.0 or higher
- PHP `curl` and `json` extensions
- Salesforce account with API access (Connected App)

## Installation

```
composer require mageme/module-webforms-3-salesforce
bin/magento setup:upgrade
bin/magento cache:flush
```

## Configuration

1. Go to **Stores > Configuration > MageMe > WebForms > Salesforce** and enter your Salesforce credentials (Client ID, Client Secret, Username, Password).
2. Open any form in the admin panel and configure the Salesforce integration tab to map form fields to lead properties.

## Other MageMe WebForms Integrations

Route your Magento 2 leads and support requests to the right tools:

- [HubSpot](https://github.com/mageme/module-webforms-3-hubspot) — sync contacts, companies, and tickets
- [Zoho CRM & Desk](https://github.com/mageme/module-webforms-3-zoho) — create leads and support tickets
- [Freshdesk](https://github.com/mageme/module-webforms-3-freshdesk) — create support tickets automatically
- [Zendesk](https://github.com/mageme/module-webforms-3-zendesk) — create tickets with custom field types
- [Klaviyo](https://github.com/mageme/module-webforms-3-klaviyo) — build profiles and grow your email lists
- [Mailchimp](https://github.com/mageme/module-webforms-3-mailchimp) — subscribe customers to audiences
- [Zapier](https://github.com/mageme/module-webforms-3-zapier) — connect forms to 7000+ apps

## About MageMe WebForms

[MageMe WebForms](https://mageme.com/magento-2-form-builder.html) is a Magento 2 extension that replaces custom form development with a no-code form builder. Create lead capture forms, quote request forms, application forms, and customer surveys — with conditional visibility, file uploads, multi-step layouts, and native CRM integrations.

[Get MageMe WebForms for Magento 2](https://mageme.com/magento-2-form-builder.html)

## Support

- Documentation: [docs.mageme.com](https://docs.mageme.com)
- Issue Tracker: [GitHub Issues](https://github.com/mageme/module-webforms-3-salesforce/issues)

## License

Proprietary. See [License](https://mageme.com/license/) for details.
