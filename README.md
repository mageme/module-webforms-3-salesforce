# MageMe WebForms Salesforce for Magento 2

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mageme/module-webforms-3-salesforce.svg?style=flat-square)](https://packagist.org/packages/mageme/module-webforms-3-salesforce)
[![Packagist Downloads](https://img.shields.io/packagist/dt/mageme/module-webforms-3-salesforce.svg?style=flat-square)](https://packagist.org/packages/mageme/module-webforms-3-salesforce)
[![Magento](https://img.shields.io/badge/Magento-2.4.x-EE672F.svg?style=flat-square)](https://magento.com)
[![PHP](https://img.shields.io/badge/PHP-7.4%20–%208.5-777BB4.svg?style=flat-square)](https://php.net)
[![License](https://img.shields.io/badge/license-MageMe%20EULA-blue.svg?style=flat-square)](https://mageme.com/license/)

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

## Custom Magento development

Need a feature an extension doesn't cover, or a bespoke Magento build? MageMe takes on custom extension development and integration work.

→ **[Custom Magento development](https://mageme.com/magento-services/custom-development)**

## Support

- Documentation: [docs.mageme.com](https://docs.mageme.com)
- Bug reports and feature requests: [GitHub Issues](https://github.com/mageme/module-webforms-3-salesforce/issues)

## License

Governed by the **MageMe End User License Agreement** ([mageme.com/license](https://mageme.com/license/)). This add-on is distributed free of charge.

---

**MageMe WebForms** is a no-code form builder for Magento 2 — conditional logic, multi-step forms, file uploads, and CRM integrations. → [Get WebForms](https://mageme.com/magento-2-form-builder.html) · [Browse all extensions](https://mageme.com/extensions)
