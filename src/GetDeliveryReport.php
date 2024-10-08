<?php

namespace AdvantaAfrica\SmsApi;

class GetDeliveryReport extends BaseFile
{


    /**
     * Fetch delivery status report GET.
     * 
     * @return string                The raw response from the API.
     * 
     * @throws GuzzleException If the request fails.
     */

    public function getDeliveryStatusGet(string $messageId): string

    {

        $response = $this->client->get($this->url, [
            'query' => [
                'apikey' => $this->apiKey,
                'partnerID' => $this->partnerId,
                'messageID' => $messageId
            ]
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Fetch delivery status report POST.
     * 
     * @return string                The raw response from the API.
     * 
     * @throws GuzzleException If the request fails.
     */

    public function getDeliveryStatusPost(string $messageId): string

    {

        $response = $this->client->post($this->url, [
            'json' => [
                'apikey' => $this->apiKey,
                'partnerID' => $this->partnerId,
                'messageID' => $messageId
            ]
        ]);

        return $response->getBody()->getContents();
    }
}
