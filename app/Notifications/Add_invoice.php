<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Add_invoice extends Notification
{
    use Queueable;

    public $invoice_id;
    public function __construct($invoice)
    {
        $this->invoice_id = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'id' => $this->invoice_id,
            'title' => 'تم اضافة فاتوره جديدة بواسطة:',
            'user' => Auth::user()->name
        ];
    }
}
