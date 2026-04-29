<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * 会員登録:名前未入力
     */
    public function test_register_name_required()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'test@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',

        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /**
 * 会員登録:メール未入力
 */
public function test_register_email_required()
{
    $response = $this->post('/register', [
        'name' => 'テスト',
        'email' => '',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertSessionHasErrors(['email']);
}

/**
 * 会員登録:パスワード未入力
 */
public function test_register_password_required()
{
    $response = $this->post('/register', [
        'name' => 'テスト',
        'email' => 'test@test.com',
        'password' => '',
        'password_confirmation' => '',
    ]);

    $response->assertSessionHasErrors(['password']);
}

/**
 * 会員登録:パスワード7文字以下
 */
public function test_register_password_min_length()
{
    $response = $this->post('/register', [
        'name' => 'テスト',
        'email' => 'test@test.com',
        'password' => '1234567',
        'password_confirmation' => '1234567',
    ]);

    $response->assertSessionHasErrors(['password']);
}

/**
 * 会員登録:確認用パスワード不一致
 */
public function test_register_password_confirmation_mismatch()
{
    $response = $this->post('/register', [
        'name' => 'テスト',
        'email' => 'test@test.com',
        'password' => 'password123',
        'password_confirmation' => 'password999',
    ]);

    $response->assertSessionHasErrors(['password']);
}

    /**会員登録:成功
     * 
     */
    public function test_register_success()
    {
        $response = $this->post('/register', [
            'name' => 'テスト',
            'email' => 'test@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/email/verify');
    }

    /**
     * ログイン:画面表示
     */
    public function test_login_success()
    {
         $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
    }

    
/**
 * ログイン:メール未入力
 */
public function test_login_email_required()
{
    $response = $this->post('/login', [
        'email' => '',
        'password' => 'password123',
    ]);

    $response->assertSessionHasErrors(['email']);
}

/**
 * ログイン:パスワード未入力
 */
public function test_login_password_required()
{
    $response = $this->post('/login', [
        'email' => 'test@test.com',
        'password' => '',
    ]);

    $response->assertSessionHasErrors(['password']);
}

/**
 * ログイン:誤った情報
 */
public function test_login_invalid_credentials()
{
    $user = \App\Models\User::factory()->create([
        'password' => bcrypt('correct-password'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
}

    /**
     * ログアウト
     */
    public function test_logout_success()
    {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $response->assertRedirect('/login');
    $this->assertGuest();
    }

    /**
     * メール認証
     */
    public function test_verification_page_redirect_after_register()
    {
        $response = $this->post('/register', [
        'name' => 'テスト',
        'email' => 'mail@test.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

     $response->assertRedirect('/email/verify');
    }


}
