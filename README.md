# Advanta Africa SMS API Package

![Version](https://img.shields.io/badge/version-1.0.0-brightgreen)

## Overview

The **Advanta Africa SMS API** package provides a simple interface for sending SMS, checking SMS balance and retrieving delivery reports using the Advanta Africa SMS APIs. This package allows you to easily integrate SMS functionalities into your PHP applications.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
  - [Configuration](#configuration)
  - [Sending SMS](#sending-sms)
  - [Sending OTP](#sending-otp)
  - [Sending OTP](#sending-sms-to-hashed-numbers)
  - [Sending Bulk SMS](#sending-bulk-sms)
  - [Getting Balance](#getting-balance)
  - [Getting Delivery Reports](#getting-delivery-reports)
- [Endpoints](#endpoints)
- [Author](#author)
- [License](#license)

## Installation

You can install this package via Composer. Run the following command:

```bash
composer require advanta_africa/sms_api
```

## Usage

### Configuration

To use the package, you need to provide the API credentials and the URL for the specific endpoint you want to interact with. You can pass the URL, API key, partner ID and sender ID directly when creating an instance of the package. These crednetials are accessible in your Advanta Africa SMS account. You can contact them for account creation

```php
use AdvantaAfrica\SmsApi\SmsApi;

// Create an instance for sending SMS, OTP, and getting balance or delivery reports
$smsApi = new SmsApi('endpoint', 'apiKey', 'partnerId', 'senderId');
```

### Sending SMS

To send a single SMS, you can use the `sendSingleSmsPost` method for POST requests or `sendSingleSmsGet` for GET requests. Both methods accept mobile numbers and a message. Optionally, you can pass timeToSend to schedule messages (or pass null if not being scheduled) and a hashed key = true when sending to hashed numbers.

#### POST Example

You can pass a single number or multiple numbers as an array (Numbers can start with 07, 0 or 254):

```php
$response = $smsApi->sendSingleSmsPost(['07xxxxxxxxxx', '07xxxxxxxxx'], 'Your message here', 'timeToSend', null);
```

#### GET Example

```php
$response = $smsApi->sendSingleSmsGet('07xxxxxxxxxxx', 'Your message here','timeToSend', null);
```

### Send OTP Endpoint usage

When using the otp endpoint, you can use the same `sendSingleSmsPost` method for POST requests or `sendSingleSmsGet` for GET requests. This is the same endpoint for sending SMS to hashed numbers. You will need to pass hashed key and value  `true`. If not passed, it will be treated as a regular mobile number.

#### POST Example

To send an SMS to a hashed mobile number using OTP endpoint:

```php
$response = $smsApi->sendSingleSmsPost(['xxxxxxxxxx'], 'Your message here', 'timeToSend', 'true');
```

To send to a regular number using OTP endpoint:

```php
$response = $smsApi->sendSingleSmsPost(['07xxxxxxxxxx'], 'Your message here', 'timeToSend',null);
```

#### GET Example

To send an SMS to a hashed mobile number using OTP endpoint:

```php
$response = $smsApi->sendSingleSmsGet('xxxxxxxxxx', 'Your message here', 'optional_time_in_string', 'true');
```

To send to a regular number using OTP endpoint:

```php
$response = $smsApi->sendSingleSmsGet('07xxxxxxxxxx', 'Your message here', 'optional_time_in_string',null);
```

### Sending Bulk SMS

To send multiple SMS messages in a single request, use the `sendBulkSms` method. This method requires an array of SMS details and is only available via POST.

#### Example

```php
$smsList = [
    [
        'partnerID' => '12345',
        'apikey' => 'apiKey',
        'mobile' => '07xxxxxxxxxxxx',
        'message' => 'This is a test message',
        'shortcode' => 'xxxxxxxxxxxx'
    },
    [
        'partnerID' => '12346',
        'apikey' => 'apiKey',
        'mobile' => '07xxxxxxxxxxxx',
        'message' => 'This is a test message 2',
        'shortcode' => 'xxxxxxxxxxxx'
    ]
];

$response = $smsApi->sendBulkSms($smsList);
```

### Getting Balance

To check your SMS balance, you can use the `getBalancePost` method for POST requests or `getBalanceGet` for GET requests.

#### POST Example

```php
$balanceResponse = $smsApi->getBalancePost(); 
```

#### GET Example

```php
$balanceResponse = $smsApi->getBalanceGet();
```

### Getting Delivery Reports

To retrieve the delivery status of an SMS, you can use the `getDeliveryStatusPost` for POST requests or `getDeliveryStatusGet` for GET requests.

#### POST Example

```php
$deliveryResponse = $smsApi->getDeliveryStatusPost('messageId');
```

#### GET Example

```php
$deliveryResponse = $smsApi->getDeliveryStatusGet('messageId');
```

## Endpoints

- **Sending Single SMS to 1 or multiple recipients**: `https://quicksms.advantasms.com/api/services/sendsms/`
- **Sending single SMS to 1 or multiple recipients via OTP route or sending to hashed mobile numbers**: `https://quicksms.advantasms.com/api/services/sendotp`
- **Sending Bulk SMS**: `https://quicksms.advantasms.com/api/services/sendbulk/`
- **Getting Balance**: `https://quicksms.advantasms.com/api/services/getbalance/`
- **Getting Delivery Report**: `https://quicksms.advantasms.com/api/services/getdlr/`

### Important Notes
- For the **Send SMS** and **Send OTP** endpoints, both use the same methods (`sendSingleSmsPost` and `sendSingleSmsGet`), but they have different URLs and may require a hashed key for SMS requests sent to a hashed mobile number.
- When scheduling messages, pass the time as a string that can be converted to a Unix timestamp. If not needed, simply omit it.
- Ensure that the `partnerId` is always numeric.
- Mobile numbers can start with 254,07 or 0 for new prefixes
- When sending to hashed numbers, make sure the number before being hashed starts with 254xxxxxxxxxx

## Author
Harold Kerry Omondi
Email: haroldkerry@gmail.com

## License

This package is licensed under the MIT License.

---
