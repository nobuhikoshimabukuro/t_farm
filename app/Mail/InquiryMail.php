<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;

class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $Subject;
    public $inquirer_name;
    public $inquiry_time;
    public $mailaddress;
    public $question;
    public $date_time;
    public $branch;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inquirer_name,$mailaddress,$question,$date_time,$branch)
    {

        $this->inquirer_name = $inquirer_name;
        $this->mailaddress = $mailaddress;
        $this->question = $question;
        $this->date_time = $date_time;
        $this->branch = $branch;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject = "";

        if($this->branch == 1){

            $subject = "ククナファームからの自動送信メールです。";

            return $this
            ->view('mails.noreply')
            ->subject($subject)
            ->with(['inquirer_name' => $this->inquirer_name , 'mailaddress' => $this->mailaddress , 'question' => $this->question , 'date_time' => $this->date_time]); 

        }else{

            $subject = "【" . $this->date_time . "】のお問い合わせです。";

            return $this
            ->view('mails.inquiry_mail')
            ->subject($subject)
            ->with(['inquirer_name' => $this->inquirer_name , 'mailaddress' => $this->mailaddress , 'question' => $this->question]); 

        }


       
    }
}
