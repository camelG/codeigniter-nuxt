<?php
use \Firebase\JWT\JWT;

class MY_Controller extends CI_Controller
{
    protected $post;
    protected $token;
    protected $user;
    protected $user_el = [
        'id',
        'name',
        'email',
        'admin',
        'last_login',
    ];

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');

        // cors optionsリクエスト対策
        if ($this->input->method() == 'options') {
            return $this->json();
        }

        // json リクエスト array post 変換
        $this->post = $this->input->raw_input_stream ? json_decode($this->input->raw_input_stream, true) : null;

        // token
        $this->token = $this->input->get_request_header('authorizationx', true) ?? null;

        // user
        if ($this->token && $this->token != 'true' && $this->token != 'false' && $this->token != 'null') {
            $data = JWT::decode($this->token, $this->config->item('encryption_key'), array('HS256'));
            $row = $this->user_model->getRow(elements(['id', 'email', 'password'], (array) $data));

            $this->user_model->updateRow(
                elements(['id', 'email', 'password'], (array) $data),
                [
                    'last_login' => date('Y-m-d H:i:s'),
                ]
            );

            $this->user = elements($this->user_el, (array) $row);
        }
    }

    public function json($response = [], int $status = 200)
    {
        // json export
        $this->output
            ->set_status_header($status)
            ->set_header('Access-Control-Allow-Origin: ' . env('ALLOW_ORIGIN'))
            ->set_header('Access-Control-Allow-Headers: *')
        // ->set_header('Access-Control-Allow-Headers: Accept,Content-type,Origin,Authorizationx')
            ->set_header('Access-Control-Expose-Headers: Content-Length,API-Key')
            ->set_header('Access-Control-Request-Method: POST,GET')
            ->set_header('Content-Type: application/json; charset=utf-8')
            ->set_output(json_encode((array) $response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }
    
}

class MY_Controller extends MY_Auth
{
    public function __construct()
    {
        parent::__construct();

        // auth
        // if (!$this->token) {
        //     return $this->json([], 401);
        // }
    }
}