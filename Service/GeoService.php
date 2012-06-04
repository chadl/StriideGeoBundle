<?php
namespace Striide\GeoBundle\Service;

class GeoService
{
  private $logger = null;
  public function __construct($doctrine,$logger)
  {
    $this->doctrine = $doctrine;
    $this->logger = $logger;
  }
  private $rest_client = null;
  public function setRestClient($client)
  {
    $this->rest_client = $client;
  }
  public function getLocationByAddress($address)
  {
    $this->logger->info(sprintf("Looking up address... (%s)", $address));
    $payload = $this->rest_client->get(sprintf("http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=%s", $address));
    $results = json_decode($payload, true);
    return $results;
  }


  public function getCountriesArray()
  {
    $repository = $this->doctrine->getEntityManager()->getRepository('StriideGeoBundle:Countries');
    $countries = $repository->getArray();
    $array = array();
    foreach ($countries as $country)
    {
      $name = $country->getName();

      if (empty($name))
      {
        continue;
      }
      $array[$name] = $name;
    }
    return $array;
  }
  public function getRegionsArrayByCountry($country)
  {

    if ($country == "Canada")
    {
      return $this->getProvincesArray();
    }

    if ($country == "United States")
    {
      return $this->getStatesArray();
    }
    return array();
  }
  public function getStatesArray()
  {
    $repository = $this->doctrine->getEntityManager()->getRepository('StriideGeoBundle:StatesUs');
    $states = $repository->getArray();
    $array = array();
    foreach ($states as $state)
    {
      $name = $state->getName();
      $code = $state->getShortCode();

      if (empty($name))
      {
        continue;
      }

      if (empty($code))
      {
        continue;
      }
      $array[$code] = $name;
    }
    return $array;
  }
  public function getProvincesArray()
  {
    $repository = $this->doctrine->getEntityManager()->getRepository('StriideGeoBundle:StatesCa');
    $provinces = $repository->getArray();
    $array = array();
    foreach ($provinces as $province)
    {
      $name = $province->getName();
      $code = $province->getShortCode();

      if (empty($code))
      {
        continue;
      }

      if (empty($name))
      {
        continue;
      }
      $array[$code] = $name;
    }
    return $array;
  }
}
