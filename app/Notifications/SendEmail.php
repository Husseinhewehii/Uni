<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SendGridMessage;

class SendEmail extends Notification
{

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $templateId;
    protected $payload;
    protected $subject;

    public function __construct($templateId, $payload = [])
    {
        $this->templateId = $templateId;
        $this->payload = $payload ;
        $this->subject = $payload["subject"] ? $payload["subject"]: config('app.name');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->templateId != "" ? ['sendgrid'] : ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSendGrid($notifiable)
    {
        return (new SendGridMessage($this->templateId))
            ->payload($this->payload)
            ->subject($this->subject)
            ->from('sirajapp2020@gmail.com', 'SirajApp')
            ->to($notifiable->email, $notifiable->first_name);
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject($this->subject)
            ->view(isset($this->payload["view"]) ? $this->payload["view"] : "mails.mail_template_body", ['data' => $this->payload]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

/**
 * $user = User::find(1);
 *   $user->notify(new SendMail());
 *
 */
