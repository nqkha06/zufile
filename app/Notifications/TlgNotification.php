<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TlgNotification extends Notification
{
    use Queueable;
    private $idTlg;
    private $msg;

    /**
     * Create a new notification instance.
     */
    public function __construct($id, $msg)
    {
        $this->idTlg = $id;
        $this->msg = $msg;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toTelegram(object $notifiable)
    {
        try {
            return TelegramMessage::create()->to($this->idTlg)->content($this->msg);
        } catch (\Exception $e) {
            \Log::error($e);
        }
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
