<?php

namespace AdvantaAfrica\SmsApi;

class GetBalance extends BaseFile
{


    /**
     * Fetch SMS Balance POST.
     * 
     * @return string                The raw response from the API.
     * 
     * @throws GuzzleException If the request fails.
     */


    public function getBalancePost(): string
    {

        $response = $this->client->post($this->url, [
            'json' => [
                'apikey' => $this->apiKey,
                'partnerID' => $this->partnerId
            ]
        ]);

        return $response->getBody()->getContents();
    }



    /**
     * Fetch SMS Balance GET.
     * 
     * @return string                The raw response from the API.
     * 
     * @throws GuzzleException If the request fails.
     */


    public function getBalanceGet(): string
    {

        $response = $this->client->get($this->url, [
            'query' => [
                'apikey' => $this->apiKey,
                'partnerID' => $this->partnerId
            ]
        ]);

        return $response->getBody()->getContents();
    }
}
