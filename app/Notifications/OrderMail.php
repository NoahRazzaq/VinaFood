<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Restaurant;
use App\Models\User;
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

        $otherUserIds = OrderLine::whereHas('order', function ($query) {
            $query->whereIn('restaurant_id', $this->groupedOrders->keys());
        })
        ->where('user_id', '!=', $notifiable->id) 
        ->pluck('user_id')
        ->unique()
        ->toArray();

        $otherUserEmails = User::whereIn('id', $otherUserIds)->pluck('email')->toArray();

        $restaurantName = Restaurant::whereIn('id', $this->groupedOrders->keys())
        ->pluck('name')
        ->implode(', ');

        return (new MailMessage)
                    ->subject('Commande chez '. $restaurantName)
                    ->cc($otherUserEmails) // Add other users to CC
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
