<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class MemberRegister extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $verificationUrl)
    {
        $this->data = $data;
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.member-register',[
                        'first_name' => $this->data->first_name,
                        'last_name' => $this->data->last_name,
                        'contact_number' => $this->data->contact_number,
                        'email' => $this->data->email,
                        'verificationUrl' => $this->verificationUrl,
                    ]);
        // $last_name = $request->last_name;
        // $first_name = $request->first_name;
        // $contact_number = $request->contact;
        // $email = $request->email;
        // return $this->view('emails.member-register', ['first_name' => $first_name, 'last_name' => $last_name, 'contact_number' => $contact_number, 'email' => $email])->to($email);
    }
}
