<?php

namespace Atrapalo\Trainings\TestDoubles\Sample3;

use Exception;
use GuzzleHttp\Client;

class GoogleSuggestKeywords
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function suggestionsFor($aQuery)
    {
        $res = $this->client->get(sprintf('http://google.com/complete/search?q=%s&output=toolbar', urlencode($aQuery)));

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string(mb_convert_encoding($res->getBody(), 'UTF-8'));

        if (!$xml) {
            $errors = array();
            foreach (libxml_get_errors() as $error) {
                $errors[] = $error->message;
            }
            libxml_clear_errors();

            throw new Exception(sprintf('Error processing XML response ("%s")', implode(' - ', $errors)));
        }

        return array_map(
            function($suggestion) {
                return (string) $suggestion['data'];
            },
            $xml->xpath('//CompleteSuggestion//suggestion')
        );
    }
}