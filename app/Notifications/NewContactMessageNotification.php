<?php

namespace App\Notifications;
use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactMessageNotification extends Notification
{
    use Queueable;
    protected $contactMessage;

    /**
     * Create a new notification instance.
     */
    public function __construct(ContactUs $contactMessage)
    {
        $this->contactMessage=$contactMessage;
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

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have received a new contact message.')
                    ->line('Name: ' . $this->contactMessage->name)
                    ->line('Email: ' . $this->contactMessage->email)
                    ->line('Phone: ' . $this->contactMessage->phone)
                    ->line('Message: ' . $this->contactMessage->message)
                    ->action('View Message', url('/admin/contact-messages/' . $this->contactMessage->id))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message_id' => $this->contactMessage->id,
            'name' => $this->contactMessage->name,
            'email' => $this->contactMessage->email,
            'phone' => $this->contactMessage->phone,
            'message'=>$this->contactMessage->message,
            'header' => 'New Contact Message Received',
            'body' => 'You have received a new message from ' . $this->contactMessage->name,
        ];
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
