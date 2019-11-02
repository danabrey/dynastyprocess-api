<?php
namespace App\Api;

class ErrorResponse
{
    public function __construct(?string $message)
    {
        $this->message = $message;
    }

    public $status = 'error';
    public $message;
}