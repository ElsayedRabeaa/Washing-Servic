<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\MailMessage;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    // public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
        // $this->url = $url;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
     public function build(){
        return $this->markdown('Email.resetPassword')->with([
            'token' => $this->token
        ]);        
    } 

   /*  public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Forgot Password?')
                    ->action('Click to reset', $this->url)
                    ->line('Thank you for using our application!');
    } */


   /*  public function sendPasswordResetNotification($token)
    {

        $url = 'http://washing.test/api/auth/createNew?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    } */
}