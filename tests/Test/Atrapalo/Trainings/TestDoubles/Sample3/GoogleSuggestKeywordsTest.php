<?php

namespace Test\Atrapalo\Trainings\TestDoubles\Sample3;

use Atrapalo\Trainings\TestDoubles\Sample3\GoogleSuggestKeywords;
use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\Message\Response as BaseResponse;
use Mockery;
use PHPUnit_Framework_TestCase;

class GoogleSuggestKeywordsTest extends PHPUnit_Framework_TestCase
{
    public function testSuggestionsFor()
    {
        $googleSuggestKeywords = new GoogleSuggestKeywords(new Client());

        $this->assertSame(
            [
                'test1',
                'test2',
                'test3',
                'test4'
            ],
            $googleSuggestKeywords->suggestionsFor('test')
        );
    }

    public function testSuggestionsForUsingMockery()
    {
        $client = Mockery::mock('\GuzzleHttp\Client');
        $response = Mockery::mock('\GuzzleHttp\Message\Response');

        $response
            ->shouldReceive('getBody')
            ->andReturn(
                <<<EOXML
<?xml version="1.0"?>
<toplevel>
    <CompleteSuggestion>
        <suggestion data="test1"/>
    </CompleteSuggestion>
    <CompleteSuggestion>
        <suggestion data="test2"/>
    </CompleteSuggestion>
    <CompleteSuggestion>
        <suggestion data="test3"/>
    </CompleteSuggestion>
    <CompleteSuggestion>
        <suggestion data="test4"/>
    </CompleteSuggestion>
</toplevel>
EOXML
            )
        ;

        $client
            ->shouldReceive('get')
            ->andReturn($response)
        ;

        $googleSuggestKeywords = new GoogleSuggestKeywords($client);

        $this->assertSame(
            [
                'test1',
                'test2',
                'test3',
                'test4'
            ],
            $googleSuggestKeywords->suggestionsFor('test')
        );
    }
}

class Client extends BaseClient
{
    public function get($url = null, $options = [])
    {
        return new Response();
    }
}

class Response extends BaseResponse
{
    public function __construct()
    {
        // Dummy override to allow instances without constructor parameters
    }

    public function getBody()
    {
        return <<<EOXML
<?xml version="1.0"?>
<toplevel>
    <CompleteSuggestion>
        <suggestion data="test1"/>
    </CompleteSuggestion>
    <CompleteSuggestion>
        <suggestion data="test2"/>
    </CompleteSuggestion>
    <CompleteSuggestion>
        <suggestion data="test3"/>
    </CompleteSuggestion>
    <CompleteSuggestion>
        <suggestion data="test4"/>
    </CompleteSuggestion>
</toplevel>
EOXML;
    }
}