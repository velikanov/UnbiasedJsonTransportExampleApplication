<?php

namespace Unbiased\JsonTransportBundle\Bridge\BuzzBundle;

use Buzz\Browser;
use Unbiased\JsonTransportBundle\Bridge\AbstractTransportBridge;
use Unbiased\JsonTransportBundle\Exception\Transport\Bridge\InvalidTransportBridgeResponseException;

class BuzzBundleBridge extends AbstractTransportBridge
{
    protected $browser;

    public static function getServiceResponder()
    {
        return 'buzz';
    }

    public function __construct(Browser $browser)
    {
        $this->browser = $browser;
    }

    public function callUrl($url, $method = 'GET', array $data)
    {
        $rawResponse = null;

        switch ($method) {
            case 'POST':
                $rawResponse = $this->browser->post($url, [], http_build_query($data));

                break;
            default:
                $rawResponse = $this->browser->get($url);

                break;
        }

        if (!empty($rawResponse)) {
            return $rawResponse;
        }

        throw new InvalidTransportBridgeResponseException($rawResponse);
    }
}