<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_system'] = function () {
    try {
        $dotenv = Dotenv\Dotenv::createImmutable(APPPATH . '../');
        $dotenv->load();
    } catch (Exception $e) {
        // print_r($e);exit;
    }

    function env(string $key, $default = null)
    {
        $value = getenv($key);
        return $value ?? $default;
    }
};
