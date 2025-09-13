<?php

namespace App\Notifications\Admin;

use App\Enum\NotificationType;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// save notification in datababase
// and broadcast it to frontend
class AdminCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $admin)
    {
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function getMessage(object $notifiable): string
    {
        return "Dear {$notifiable->name}, a new admin with name {$this->admin->name} has been added";
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // 'recipient_id' => $notifiable->id,
            'admin_id' => $this->admin->id,
            'admin_name' => $this->admin->name,
            'message' => $this->getMessage($notifiable),
            'link' => "/admins/admins/{$this->admin->id}",
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'payload' => [
                'message' => [
                    $this->getMessage($notifiable),
                ],
            ],
        ]);
    }

    /**
     * Get the notification's database type.
     */
    public function databaseType(object $notifiable): string
    {
        return NotificationType::AdminCreated->value;
    }
}
