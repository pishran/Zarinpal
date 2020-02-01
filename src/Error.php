<?php

namespace Pishran\Zarinpal;

class Error
{
    private $status = 0;

    public function __construct(int $status)
    {
        $this->status = $status;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function message(): string
    {
        switch ($this->status) {
            case 0:
                return 'امکان ارتباط با سرور زرین پال وجود ندارد.';
            case -1:
                return 'اطلاعات ارسال شده ناقص است.';
            case -2:
                return 'IP یا مرچنت کد پذیرنده صحیح نیست.';
            case -3:
                return 'با توجه به محدودیت های شاپرک امکان پرداخت با رقم درخواست شده میسر نمی باشد.';
            case -4:
                return 'سطح تایید پذیرنده پایین تر از سطح تایید نقره ای است.';
            case -11:
                return 'درخواست مورد نظر یافت نشد.';
            case -12:
                return 'امکان ویرایش درخواست میسر نمی باشد.';
            case -21:
                return 'هیچ نوع عملیات مالی برای این تراکنش یافت نشد.';
            case -22:
                return 'تراکنش ناموفق می باشد.';
            case -33:
                return 'رقم تراکنش با رقم پرداخت شده مطابقت ندارد.';
            case -34:
                return 'سقف تقسیم تراکنش از لحاظ تعداد یا رقم عبور نموده است.';
            case -40:
                return 'اجازه دسترسی به متد مربوطه وجود ندارد.';
            case -41:
                return 'اطلاعات ارسال شده مربوط به AdditionalData غیرمعتبر می باشد.';
            case -42:
                return 'مدت زمان معتبر طول عمر شناسه پرداخت باید بین 30 دقیقه تا 45 روز باشد.';
            case -54:
                return 'درخواست مورد نظر آرشیو شده است.';
            case 101:
                return 'عملیات پرداخت موفق بوده و قبلا PaymentVerification تراکنش انجام شده است.';
            default:
                return 'خطای پیش بینی نشده ای رخ داده است.';
        }
    }
}
