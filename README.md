# زرین پال | Zarinpal

Zarinpal library for Laravel based on Zarinpal API v4

کتابخانه زرین پال برای لاراول براساس نسخه 4 ای‌پی‌آی زرین پال

## روش نصب - Installation

Use composer to install this package

برای نصب و استفاده از این پکیج می توانید از کمپوسر استفاده کنید

```bash
composer require pishran/zarinpal
```

## تنظیمات - Configuration

Add your merchant id to .env file

مرچنت کد خود را اضافه کنید

```dotenv
ZARINPAL_MERCHANT_ID=00000000-0000-0000-0000-000000000000
```

You can also define merchant id at runtime.

امکان تعیین مرچنت کد در حین اجرا نیز وجود دارد که در ادامه توضیح داده خواهد شد.

To change currency to Toman (Default) 

برای تغییر واحد پول به تومان (مقدار پیشفرض)

```dotenv
ZARINPAL_CURRENCY=IRT
```

To change currency to Rial

برای تغییر واحد پول به ریال

```dotenv
ZARINPAL_CURRENCY=IRR
```

## روش استفاده | How to use

### ارسال مشتری به درگاه پرداخت | Send customer to payment gateway

```php
$response = zarinpal()
    ->merchantId('00000000-0000-0000-0000-000000000000') // تعیین مرچنت کد در حین اجرا - اختیاری
    ->amount(100) // مبلغ تراکنش
    ->request()
    ->description('transaction info') // توضیحات تراکنش
    ->callbackUrl('https://domain.com/verification') // آدرس برگشت پس از پرداخت
    ->mobile('09123456789') // شماره موبایل مشتری - اختیاری
    ->email('name@domain.com') // ایمیل مشتری - اختیاری
    ->send();

if (!$response->success()) {
    return $response->error()->message();
}

// ذخیره اطلاعات در دیتابیس
// $response->authority();

// هدایت مشتری به درگاه پرداخت
return $response->redirect();
```

### بررسی وضعیت تراکنش | Verify payment status

```php
$authority = request()->query('Authority'); // دریافت کوئری استرینگ ارسال شده توسط زرین پال
$status = request()->query('Status'); // دریافت کوئری استرینگ ارسال شده توسط زرین پال

$response = zarinpal()
    ->merchantId('00000000-0000-0000-0000-000000000000') // تعیین مرچنت کد در حین اجرا - اختیاری
    ->amount(100)
    ->verification()
    ->authority($authority)
    ->send();

if (!$response->success()) {
    return $response->error()->message();
}

// دریافت هش شماره کارتی که مشتری برای پرداخت استفاده کرده است
// $response->cardHash();

// دریافت شماره کارتی که مشتری برای پرداخت استفاده کرده است (بصورت ماسک شده)
// $response->cardPan();

// پرداخت موفقیت آمیز بود
// دریافت شماره پیگیری تراکنش و انجام امور مربوط به دیتابیس
return $response->referenceId();
```
