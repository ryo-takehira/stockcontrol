<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    // コンストラクタ
    public function __construct()
    {
        // メールで使う情報があれば主にコンストラクタの引数で受け取る
    }


		// メールを送るメソッド
        public function build()
        {
                    // メールを送る
            return $this->to('toppotake800@gmail.com')             // 宛先
                        ->subject('会員登録が完了しました')     // 件名
                        ->view('mail.NotificationEmail')        // 本文（HTMLメール）
                        ->text('mail.WelcomeEmail_text');       // 本文（プレーンテキストメール）
        }
    

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
