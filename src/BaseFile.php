<?php

namespace AdvantaAfrica\SmsApi;

use GuzzleHttp\Client;

class BaseFile
{

    protected $url;
    protected $apiKey;
    protected $partnerId;
    protected $client;
    protected $senderId;

    public function __construct(string $url, string $apiKey, int $partnerId, string $senderId)
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
        $this->partnerId = $partnerId;
        $this->senderId = $senderId;
        $this->client = new Client();
    }
}
