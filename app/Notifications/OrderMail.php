<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class OrderMail extends Notification
{
    use Queueable;

    public $groupedOrders;
    /**
     * Create a new notification instance.
     */
    public function __construct(Collection $groupedOrders)
    {
        $this->groupedOrders = $groupedOrders;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    { 


        // dd($this->order->orderlines);
        return (new MailMessage)
                    ->subject('Commande chez')
                    // ->cc($this->order->orderlines->user->email, $this->order->orderlines->user->name)
                    ->view('emails/orderemail', [
                        'notifiable' => $notifiable,
                        'groupedOrders' => $this->groupedOrders, 
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
