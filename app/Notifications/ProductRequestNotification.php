<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */


    protected $productRequest;


    public function __construct($productRequest)
    {
        //
        $this->productRequest = $productRequest;
        // dd($productRequest);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $message = (new MailMessage)
            ->subject('New Product Request')
            ->line('A new product request has been made.')
            ->line('Product: ' . $this->productRequest->product)
            ->line('Price: ' . $this->productRequest->price);

        if ($this->productRequest->emergency) {
            $message->line('**This is an emergency request!**');
        }

        $message->action('View Product Request', route('admin-product-requests', ['admin' => $this->productRequest->id]))
                ->line('Thank you for using our application!');

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
           
        ];
    }
}
