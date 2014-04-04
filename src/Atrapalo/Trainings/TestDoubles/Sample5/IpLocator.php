<?php

namespace Atrapalo\Trainings\TestDoubles\Sample5;

use SoapClient;

class IpLocator
{
    /**
     * @var SoapClient
     */
    private $soapClient;

    /**
     * @return \SoapClient
     */
    public function getSoapClient()
    {
        if (null === $this->soapClient) {
            ini_set('cache_wsdl', false);
            $this->soapClient = new SoapClient('http://www.webservicex.net/geoipservice.asmx?WSDL', ['soap_version' => SOAP_1_2]);
        }

        return $this->soapClient;
    }

    /**
     * @param \SoapClient $soapClient
     */
    public function setSoapClient($soapClient)
    {
        $this->soapClient = $soapClient;
    }

    public function locate($ipAddress)
    {
        $location = $this->getSoapClient()->GetGeoIP(['IPAddress' => $ipAddress]);

        return $location->GetGeoIPResult->CountryName;
    }
}