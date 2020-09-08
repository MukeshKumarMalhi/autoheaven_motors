<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $form_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form_data)
    {
      $this->form_data = $form_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('emails.review_email', ['form_data', $this->form_data])
                  ->from($this->form_data['email'], $this->form_data['full_name'])
                  ->replyTo($this->form_data['email'], $this->form_data['full_name'])
                  ->subject('Autohaven Review');
    }
}
