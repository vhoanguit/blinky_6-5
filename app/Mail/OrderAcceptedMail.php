<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\tbl_customer_order;

class OrderAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(tbl_customer_order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Đơn hàng đã được duyệt')
                    ->view('emails.order_accepted')
                    ->with([
                        'customerName' => $this->order->customer_name,
                        'orderDate' => $this->order->order_date,
                    ]);
    }
}