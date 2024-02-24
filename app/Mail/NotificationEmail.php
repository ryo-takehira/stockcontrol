<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;


        // ②ただのプライベートプロパティ
		// publicにするとビューで使えてしまうの、あえてプライベートにしている
        private $user;

    /**
     * Create a new message instance.
     */
    // コンストラクタ
    public function __construct(User $user)
    {
        // メールで使う情報があれば主にコンストラクタの引数で受け取る
        // ①ユーザーデータを保持するため一旦プロパティに入れる
        $this->user= $user;

    }


		// メールを送るメソッド
        public function build(Request $request)
        {

            $user_id = $request['user_id'];
            $isAdmin=$request['isAdmin'];

            if($isAdmin=2){
                    // メールを送る
            return $this->to('toppotake800@gmail.com')             // 宛先
                        ->subject('在庫が不足しています')     // 件名
                        ->view('mail.NotificationEmail')        // 本文（HTMLメール）
                        ->text('mail.WelcomeEmail_text');   // 本文（プレーンテキストメール）
        }
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
            view: 'mail.NotificationEmail',
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
