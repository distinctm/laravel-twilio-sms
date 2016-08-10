# Twilio Channel for Laravel Notifications

[Twilio](http://twilio.com) driver for sending SMS with Laravel Notifications.

This is pretty much a port of Laravel's default [SMS driver](https://laravel.com/docs/master/notifications#sms-notifications).

## Getting Started  
1. Install with composer - `composer require koomai/laravel-twilio-sms`. This also installs the `aloha/twilio` package.

2. Add `'Aloha\Twilio\Support\Laravel\ServiceProvider'::class` to `config/app.php`

3. Publish the config file `php artisan vendor:publish`

4. Go to `config/twilio.php` and add your Twilio credentials plus the number you're sending from. *Hint:* Use the `.env` file.

## Usage

Follow Laravel's documentation to add the channel to the `via` method and create a representation of the notification.  

```
/**
 * Get the notification's delivery channels.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function via($notifiable)
{
    return [TwilioSmsChannel::class];
}

/**
 * Get the SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return TwilioMessage
 */
public function toTwilio($notifiable)
{
    return (new TwilioMessage)
	                ->content('This is a test SMS via Plivo using Laravel Notifications!');
	                // ->from('+61455222900'); Chain this method to override default 'from' number
}
```
