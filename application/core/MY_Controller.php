<?php

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
