<?php

namespace App\Mail;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
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
        $order = Order::find($this->order->id);
        $pdf = PDF::loadView('pdf_test', compact('order'));

        return $this->subject('Ninetynine Invoice #' . $this->order->id)
            ->markdown('emails.sendemail')->attachData($pdf->output(), "INV-" . $order->id . ".pdf");
    }
}
