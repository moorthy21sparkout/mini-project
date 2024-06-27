<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskRemainingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $task;
    public function __construct(Task $task)
    {
        //
        $this->task = $task;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Task Remaining Mail',
        );
    }

    /**
     * Get the message build definition.
     *
     * @return \Illuminate\Mail\Mailables\build
     */
    public function build()
    {

        return $this->subject('Task Remaining Mail')
            ->view('mail.remainder')
            ->with([
                'data' => $this->task, // Pass 'task' instead of 'data'
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
