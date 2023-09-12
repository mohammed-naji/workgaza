<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $name, $total;

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $total)
    {
        $this->name = $name;
        $this->total = $total;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // main, database, broadcast, vonage, slack
        return ['broadcast', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Dear Ahmed')
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    // function toDatabase(object $notifiable) : array {
    //     return [
    //         'msg' => 'New Order has been created to '.$this->name.' with total = '.$this->total.'$',
    //         'link' => '/orders'
    //     ];
    // }

    // function toBroadcast(object $notifiable) : array {
    //     return [
    //         'msg' => 'New Order has been created to '.$this->name.' with total = '.$this->total.'$',
    //         'link' => '/orders'
    //     ];
    // }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'msg' => 'New Order has been created to '.$this->name.' with total = '.$this->total.'$',
            'link' => '/orders'
        ];
    }
}
