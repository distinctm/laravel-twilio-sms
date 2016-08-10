<?php

namespace Koomai\Twilio\Notifications;

use Illuminate\Notifications\Notification;
use Aloha\Twilio\Twilio;

class TwilioSmsChannel
{
    /**
     * The Twilio instance.
     *
     * @var \Aloha\Twilio\Twilio;
     */
    protected $twilio;

    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('twilio')) {
            return;
        }

        $message = $notification->toTwilio($notifiable);

        if (is_string($message)) {
            $message = new Twilio($message);
        }

        $configKey = config('twilio.twilio.default');
        $config = config('twilio.twilio.connections.' . $configKey);
        $this->from = $message->from ?: $config['from'];
        $this->twilio = new Twilio($config['sid'], $config['token'], $this->from);

        $this->twilio->message($to, trim($message->content));
    }
}
