<?php

namespace Tests\Unit;

use App\Mail\TestDinamicEmail;
use App\Mail\TestEmail;
use App\Mail\TestTextEmail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function send_markdown_email()
    {
        // 1
        $user = factory(User::class)->create();
        // 2
        Mail::to($user)->send(new TestEmail());
        $this->assertTrue(true);
    }
    /**
     * @test
     */
    public function send_text_email()
    {
        // 1
        $user = factory(User::class)->create();
        // 2
        Mail::to($user)->send(new TestTextEmail());
        $this->assertTrue(true);
    }
    /**
     * @test
     */
    public function send_markdown_email_dinamic()
    {
        // 1
        $user = factory(User::class)->create();
        // 2
        Mail::to($user)->send(new TestDinamicEmail($user));
        $this->assertTrue(true);
    }
}