<?php

namespace AppBundle\Extension;

use Symfony\Component\Intl\Intl;
use Twig_Environment;

class CountryExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [new \Twig_SimpleFilter('countryName', [$this, 'countryName'])];
    }

    public function countryName($countryCode)
    {
        return Intl::getRegionBundle()->getCountryName($countryCode);
    }

    public function initRuntime(Twig_Environment $environment)
    {
        // TODO: Implement initRuntime() method.
    }

    public function getName()
    {
        return 'country_extension';
    }
}
