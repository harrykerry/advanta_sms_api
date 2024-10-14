<?php

namespace AdvantaAfrica\SmsApi;

class SendSms extends BaseFile

{

    /**
     * Send a single SMS using a GET request.
     * 
     * @param string       $msisdn   The recipient's phone number.
     * @param string       $message  The message to send.
     * @param string       $hashed    Boolean value passed as true for hashed numbers
     * 
     * @return string                The raw response from the API.
     * 
     * @throws GuzzleException If the request fails.
     */

    public function sendSingleSmsGet(string $msisdn, string $message,string $time = null, string $hashed = null): string
    {


        $queryParams = [
            'apikey' => $this->apiKey,
            'partnerID' => $this->partnerId,
            'shortcode' => $this->senderId,
            'mobile' => $msisdn,
            'message' => $message,
        ];

        if ($time !== null) {
            $queryParams['timeToSend'] = $time;
        }

        if ($hashed !== null) {
            $queryParams['hashed'] = $hashed;
        }

        $response = $this->client->get($this->url, [
            'query' => $queryParams
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Send SMS using a POST request, supporting single or multiple comma-separated numbers.
     * 
     * @param array       $msisdn   The recipient(s) phone number
     * @param string       $message  The message to send.
     * @param string       $time      Time to send when scheduling messages. Date string that resolves to a unix timestamp
     * @param string       $hashed    Boolean value passed as true for hashed numbers
     * 
     * @return string                The raw response from the API.
     * 
     * @throws GuzzleException If the request fails.
     */

    public function sendSingleSmsPost(string $msisdn, string $message, string $time = null, string $hashed = null): string
    {

        $msisdnString = implode(',', $msisdn);

        $payload = [
            'apikey' => $this->apiKey,
            'partnerID' => $this->partnerId,
            'shortcode' => $this->senderId,
            'mobile' => $msisdnString,
            'message' => $message,
        ];

        if ($time !== null) {
            $payload['timeToSend'] = $time;
        }

        if ($hashed !== null) {
            $payload['hashed'] = $hashed;
        }

        $response = $this->client->post($this->url, [
            'json' => [$payload]
        ]);

        return $response->getBody()->getContents();
    }


    /**
     * Send bulk SMS using a POST request.
     * 
     * @param array $smsList An array of SMS data, each containing the necessary parameters.
     * 
     * @return string The raw response from the API.
     * 
     * @throws GuzzleException If the request fails.
     */

    public function sendBulkSms(array $smsList): string
    {
        $payload = [
            'count' => count($smsList),
            'smslist' => []
        ];

        foreach ($smsList as $sms) {
            $smsEntry = [
                'partnerID' => $this->partnerId,
                'apikey' => $this->apiKey,
                'mobile' => $sms['mobile'],
                'message' => $sms['message'],
                'shortcode' => $this->senderId
            ];

            $payload['smslist'][] = $smsEntry;
        }

        $response = $this->client->post($this->url, [
            'json' => $payload
        ]);

        return $response->getBody()->getContents();
    }
}
