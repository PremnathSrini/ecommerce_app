<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // $port = config('app.url_port');
        // $url = route('list.order') . ':' . $port;
        $url = config('app.url');
        $full_url = $url .':8002/user/orders';
        return (new MailMessage)
                    ->greeting('Hello Valuable User')
                    ->line('Your order status has been updated')
                    ->action('View your orders', $full_url)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [

        ];
    }
    public function toDatabase(object $notifiable){
        return [
            'id' => $this->order->user_id,
            'title' => 'Status Update [#Order'.$this->order->id.']',
            'description' => $this->order->status->description,
        ];
    }
}
