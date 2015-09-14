<?php

namespace Unbiased\JsonTransportBundle\Bridge\BuzzBundle;

use Buzz\Browser;
use Unbiased\JsonTransportBundle\Bridge\AbstractTransportBridge;
use Unbiased\JsonTransportBundle\Exception\Transport\Bridge\InvalidTransportBridgeResponseException;

class BuzzBundleBridge extends AbstractTransportBridge
{
    protected $browser;

    /**
     * @return string
     */
    public static function getServiceResponder()
    {
        return 'buzz';
    }

    /**
     * @param Browser $browser
     */
    public function __construct(Browser $browser)
    {
        $this->browser = $browser;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $data
     * @return string
     * @throws InvalidTransportBridgeResponseException
     */
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