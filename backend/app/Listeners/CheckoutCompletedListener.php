<?php

namespace App\Listeners;

use App\Events\CheckoutCompletedEvent;
use App\Interfaces\Repositories\CouponRepositoryInterface;
use App\Mail\NewCouponEmail;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class CheckoutCompletedListener implements ShouldQueue
{
    private const COUPON_AMOUNT = 5.00;
    private const MINIMUM_AMOUNT = 5.00;

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 900;

    private $couponRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutCompletedEvent  $event
     * @return void
     */
    public function handle(CheckoutCompletedEvent $event)
    {
        $couponData = [
            'code' => $this->generateUniqueCode(),
            'amount' => static::COUPON_AMOUNT,
            'minimum_amount' => static::MINIMUM_AMOUNT
        ];

        $coupon = $this->couponRepository->create($couponData);
        $this->sendNewCouponEmail($event->checkout->user, $coupon);
    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\OrderShipped  $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(CheckoutCompletedEvent $event, $exception)
    {
        dd($exception->getMessage());
    }
    /**
     * @param User   $user
     * @param Coupon $coupon
     */
    private function sendNewCouponEmail(User $user, Coupon $coupon)
    {
        $mail = new NewCouponEmail($user, $coupon);
        Mail::to('ardiit777@gmail.com')->send($mail);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    private function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while ($this->couponRepository->getCouponByCode($code));

        return $code;
    }
}
