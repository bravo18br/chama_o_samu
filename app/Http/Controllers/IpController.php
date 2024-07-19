<?php

namespace App\Http\Controllers;

use IP2LocationLaravel;

class IpController extends Controller
{
    public function lookup()
    {
        $records = IP2LocationLaravel::get('8.8.8.8', 'bin'); // Funciona assim mesmo, dando erro....

        echo 'IP Number             : ' . $records['ipNumber'] . "<br>";
        echo 'IP Version            : ' . $records['ipVersion'] . "<br>";
        echo 'IP Address            : ' . $records['ipAddress'] . "<br>";
        echo 'Country Code          : ' . $records['countryCode'] . "<br>";
        echo 'Country Name          : ' . $records['countryName'] . "<br>";
        echo 'Region Name           : ' . $records['regionName'] . "<br>";
        echo 'City Name             : ' . $records['cityName'] . "<br>";
        echo 'Latitude              : ' . $records['latitude'] . "<br>";
        echo 'Longitude             : ' . $records['longitude'] . "<br>";
        echo 'Area Code             : ' . $records['areaCode'] . "<br>";
        echo 'IDD Code              : ' . $records['iddCode'] . "<br>";
        echo 'Weather Station Code  : ' . $records['weatherStationCode'] . "<br>";
        echo 'Weather Station Name  : ' . $records['weatherStationName'] . "<br>";
        echo 'MCC                   : ' . $records['mcc'] . "<br>";
        echo 'MNC                   : ' . $records['mnc'] . "<br>";
        echo 'Mobile Carrier        : ' . $records['mobileCarrierName'] . "<br>";
        echo 'Usage Type            : ' . $records['usageType'] . "<br>";
        echo 'Elevation             : ' . $records['elevation'] . "<br>";
        echo 'Net Speed             : ' . $records['netSpeed'] . "<br>";
        echo 'Time Zone             : ' . $records['timeZone'] . "<br>";
        echo 'ZIP Code              : ' . $records['zipCode'] . "<br>";
        echo 'Domain Name           : ' . $records['domainName'] . "<br>";
        echo 'ISP Name              : ' . $records['isp'] . "<br>";
        echo 'Address Type          : ' . $records['addressType'] . "<br>";
        echo 'Category              : ' . $records['category'] . "<br>";
    }
}
