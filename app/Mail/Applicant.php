<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings\SettingModel;

class Applicant extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $admin = SettingModel::where('id', 1)->first();
        $mail = $admin->email_primary;
        $last_name = $request->last_name;
        $first_name = $request->first_name;
        $contact_number = $request->contact;
        $email = $request->email;
        $filePath = storage_path('uploads/doc/'.$request->file);;
        return $this->view('emails.applicant', ['first_name' => $first_name, 'last_name' => $last_name, 'contact_number' => $contact_number, 'email' => $email])->to($mail)->attach($filePath);
    }
}