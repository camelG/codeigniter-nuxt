<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Auth extends MY_Auth
{
    public function login()
    {
        if (!$this->post) {
            return $this->json(['result' => false]);
        }

        $user = $this->user_model->getRow($this->post);

        if (!$user) {
            return $this->json(['result' => false, 'message' => 'login error'], 401);
        }

        $jwt = JWT::encode($user, $this->config->item('encryption_key'));

        $response = ['result' => true, 'token' => $jwt];
        $this->json($response);
    }

    public function logout()
    {
        return $this->json(['status' => 'OK']);
    }

    public function register()
    {
        if (!$this->post) {
            return $this->json(['result' => false, 'code' => 'register1', 'post' => $this->post]);
        }

        if ($this->user_model->getRow(['email' => $this->post['email']])) {
            return $this->json(['result' => false, 'message' => 'メールアドレスすでに登録されています']);
        }

        $id = $this->user_model->insertRow($this->post);

        return $id ? $this->json(['result' => true, 'id' => $id]) : $this->json(['result' => false, 'code' => 'register2'], 406);
    }

    public function user()
    {
        if (!$this->token) {
            return $this->json(['token' => $this->token, 'user' => $this->user, 'post' => $this->input->post()], 401);
            return $this->json([], 401);
        }
        if ($this->user) {
            $this->json(["user" => elements($this->user_el, (array) $this->user)]);
        } else {
            return $this->json(['result' => false, 'message' => 'token error'], 401);
        }
    }

    public function forgotpass()
    {
        if (!$this->post || !$this->post['email']) {
            return $this->json(['result' => false, 'message' => 'メール入力してください', 'post' => $this->post]);
        }

        $row = $this->user_model->getRow(['email' => $this->post['email']]);

        if (!$row || !isset($row->password)) {
            return $this->json(['result' => false, 'message' => 'ユーザーが存在しません']);
        }

        $this->load->library('email');
        $this->email->initialize([
            'smtp_host' => env('SMTP_HOST'),
            'smtp_user' => env('SMTP_USER'),
            'smtp_pass' => env('SMTP_PASS'),
            // 'smtp_port' => env('SMTP_PORT'),
            // 'smtp_crypto' => env('SMTP_CRYPTO'),
            'protocol' => 'smtp',
            'wordwrap' => false,
        ]);

        $this->email->from(env('SMTP_USER'));
        $this->email->to($row->email);
        $this->email->bcc(env('SMTP_USER'));

        $this->email->subject('パスワード送信');

        $msg = 'パスワード: ';
        $msg .= $row->password;
        $this->email->message($msg);

        $this->email->set_wordwrap(false);

        if ($this->email->send()) {
            return $this->json(['result' => true, 'message' => 'メール送信しました。']);
        } else {
            return $this->json(['result' => false, 'message' => 'メール送信失敗しました。']);
        }
    }
}
