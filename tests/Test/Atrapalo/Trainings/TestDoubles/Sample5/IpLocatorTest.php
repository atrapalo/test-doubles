<?php

namespace Test\Atrapalo\Trainings\TestDoubles\Sample5;

use Atrapalo\Trainings\TestDoubles\Sample5\IpLocator;
use Mockery;
use PHPUnit_Framework_TestCase;
use SoapClient;

class IpLocatorTest extends PHPUnit_Framework_TestCase
{
    public function testLocate()
    {
        $anIPAddress = '127.0.0.1';

        $soapClient = new SoapClientMock([
            'GetGeoIP' => [
                'times' => 1,
                'arguments' => [
                    ['IPAddress' => $anIPAddress]
                ],
                'return' => (object)[
                        'GetGeoIPResult' => (object) [
                            'CountryName' => 'Spain'
                        ]
                    ]
            ]
        ]);

        $ipLocator = new IpLocator();
        $ipLocator->setSoapClient($soapClient);

        $this->assertSame('Spain', $ipLocator->locate($anIPAddress));
        $this->assertTrue($soapClient->verify());
    }

    public function testLocateWithMockery()
    {
        $anIPAddress = '127.0.0.1';

        $soapClient = Mockery::mock('\SoapClient');
        $soapClient
            ->shouldReceive('GetGeoIP')
            ->once()
            ->with(['IPAddress' => $anIPAddress])
            ->andReturn((object) [
                'GetGeoIPResult' => (object) [
                    'CountryName' => 'Spain'
                ]
            ])
        ;

        $ipLocator = new IpLocator();
        $ipLocator->setSoapClient($soapClient);

        $this->assertSame('Spain', $ipLocator->locate($anIPAddress));
    }
}

class SoapClientMock extends SoapClient
{
    private $expectations = [];
    private $madeCalls = [];

    public function __construct(array $expectations)
    {
        $this->expectations = $expectations;
    }

    public function GetGeoIp()
    {
        if (!isset($this->madeCalls['GetGeoIP'])) {
            $this->madeCalls['GetGeoIP'] = [];
        }

        $this->madeCalls['GetGeoIP'][] = func_get_args();

        if (isset($this->expectations['GetGeoIP'])) {
            return $this->expectations['GetGeoIP']['return'];
        }
    }

    public function verify()
    {
        foreach ($this->expectations as $methodName => $expectation) {
            if (!in_array($methodName, array_keys($this->madeCalls))) {
                return false;
            }

            $calls = $this->madeCalls[$methodName];

            if (count($calls) !== $expectation['times']) {
                return false;
            }

            foreach ($calls as $invocationArguments) {
                if ($invocationArguments !== $expectation['arguments']) {
                    return false;
                }
            }
        }

        return true;
    }
}