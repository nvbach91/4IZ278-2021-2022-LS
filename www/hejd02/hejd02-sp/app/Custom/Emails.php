<?php

namespace App\Custom;

use Illuminate\Support\Facades\Mail;

class Emails
{
    public static function orderUserEmail($order, $orderProducts, $pdf) {
        Mail::send('email.orderEmail', ['data' => $order, 'products' => $orderProducts, 'subject' => Texts::SENT_MESSAGE_ORDER], function ($orderEmail) use ($order, $pdf) {
            $orderEmail->to($order->user->email)
                ->subject(Texts::SENT_MESSAGE_ORDER)
                ->replyTo(Texts::EMAIL_FROM)
                ->attachData($pdf->output(), "Faktura.pdf");
        });
    }
    public static function orderAdminEmail($order, $orderProducts, $pdf) {
        Mail::send('email.orderEmail', ['data' => $order, 'products' => $orderProducts, 'subject' => Texts::SENT_MESSAGE_ORDER], function ($orderEmail) use ($order, $pdf) {
            $orderEmail->to(Texts::EMAIL_FROM)->subject(Texts::SENT_MESSAGE_ORDER);
        });
    }
}
