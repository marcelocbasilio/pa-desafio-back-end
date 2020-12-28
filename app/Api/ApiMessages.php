<?php


namespace App\Api;

/**
 * Class ApiMessages
 * @package App\Api
 */
class ApiMessages
{
    /** @var array */
    private $message = [];

    /**
     * ApiMessages constructor.
     * @param string $message
     * @param array $data
     */
    public function __construct(string $message, array $data = [])
    {
        $this->message['message'] = $message;
        $this->message['errors'] = $data;
    }

    /**
     * @return array
     */
    public function getMessage(): array
    {
        return $this->message;
    }


}
