<?php

namespace Pishran\Zarinpal;

class Error
{
    /** @var int */
    private $code;

    public function __construct(int $code)
    {
        $this->code = $code;
    }

    public function code(): int
    {
        return $this->code;
    }

    public function message(): string
    {
        switch ($this->code) {
            case -9 :
                return 'خطای اعتبار سنجی';
            case -10 :
                return 'آی‌پی و یا مرچنت كد پذیرنده صحیح نیست.';
            case -11 :
                return 'مرچنت کد فعال نیست؛ لطفا با تیم پشتیبانی ما تماس بگیرید.';
            case -12 :
                return 'تلاش بیش از حد در یک بازه زمانی کوتاه';
            case -15 :
                return 'ترمینال شما به حالت تعلیق در آمده است؛ با تیم پشتیبانی تماس بگیرید.';
            case -16 :
                return 'سطح تایید پذیرنده پایین‌تر از سطح نقره‌ای است.';
            case -30 :
                return 'اجازه دسترسی به تسویه اشتراکی شناور ندارید.';
            case -31 :
                return 'حساب بانکی تسویه را به پنل اضافه کنید؛ مقادیر وارد شده برای تسهیم درست نیست.';
            case -32 :
                return 'مقادیر وارد شده برای تسهیم درست نیست و از مقدار حداکثر بیشتر است.';
            case -33 :
                return 'درصدهای وارد شده درست نیست.';
            case -34 :
                return 'مبلغ از کل تراکنش بیشتر است.';
            case -35 :
                return 'تعداد افراد دریافت کننده تسهیم بیش از حد مجاز است.';
            case -40 :
                return 'مقادیر extra درست نیست؛ expire_in معتبر نیست.';
            case -50 :
                return 'مبلغ پرداخت شده با مقدار مبلغ در وریفای متفاوت است.';
            case -51 :
                return 'پرداخت ناموفق';
            case -52 :
                return 'خطای غیر منتظره؛ با پشتیبانی تماس بگیرید.';
            case -53 :
                return 'اتوریتی برای این مرچنت کد نیست.';
            case -54 :
                return 'اتوریتی نامعتبر است.';
            case -101 :
                return 'تراکنش قبلا وریفای شده است.';
            default:
                return 'خطای پیش بینی نشده‌ای رخ داده است.';
        }
    }
}
