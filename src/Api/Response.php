<?php
namespace App\Api;

class Response
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public $status = 'success';
    public $data;
}