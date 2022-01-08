<?php

namespace App\Mail;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCouponEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Coupon
     */
    private $coupon;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Coupon $coupon)
    {
        $this->user = $user;
        $this->coupon = $coupon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('You received a new coupon!')
            ->view('emails.new-coupon', [
                'name' => $this->user->name,
                'couponCode' => $this->coupon->code,
            ]);
    }
}
