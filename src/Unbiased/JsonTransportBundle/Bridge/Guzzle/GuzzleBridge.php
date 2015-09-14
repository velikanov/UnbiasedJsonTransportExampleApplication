<?php

namespace Unbiased\JsonTransportBundle\Bridge\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Unbiased\JsonTransportBundle\Bridge\AbstractTransportBridge;
use Unbiased\JsonTransportBundle\Exception\Transport\Bridge\InvalidTransportBridgeResponseException;

class GuzzleBridge extends AbstractTransportBridge
{
    public static function getClassResponder()
    {
        return '\GuzzleHttp\Client';
    }

    public function callUrl($url, $method = 'GET', array $data)
    {
        switch ($method) {
            case 'POST':
                $request = new Request($method, $url, [], http_build_query($data));

                break;
            default:
                $request = new Request($method, $url);

                break;
        }

        $client = new Client();

        $rawResponse = $client->send($request);

        if (!empty($rawResponse) && $rawResponse instanceof Response) {
            return $rawResponse->getBody();
        }

        throw new InvalidTransportBridgeResponseException($rawResponse);
    }
}