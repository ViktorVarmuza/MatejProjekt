<?php

namespace App\Services;

use League\ISO3166\ISO3166;

class CountryService
{
    protected $iso3166;
    public function __construct(ISO3166 $iso3166)
    {
        $this->iso3166 = $iso3166;
    }

    public function getCountry($countryCode)
    {
        $country = (new ISO3166())->alpha2($countryCode);
        return $country;        
    }
}
