<?php
namespace Striide\GeoBundle\Service;

use Striide\GeoBundle\Entity\GeoIP;

class GeoService
{
  /**
   *
   */
  private $logger = null;

  /**
   *
   */
  public function __construct($doctrine,$logger)
  {
    $this->doctrine = $doctrine;
    $this->logger = $logger;
  }

  /**
   *
   */
  private $rest_client = null;

  /**
   *
   */
  public function setRestClient($client)
  {
    $this->rest_client = $client;
  }

  /**
   * @return GeoIP
   */
  public function getLocationByIp($ip)
  {
    //

    $this->logger->info(sprintf("Looking up address by ip... (%s)",$ip));

    $em = $this->doctrine->getEntityManager();
    $repo = $em->getRepository('StriideGeoBundle:GeoIP');

    $geoip = $repo->findOneByIp($ip);

    if(!empty($geoip))
    {
      return $geoip;
    }

    try
    {
      $payload = $this->rest_client->get(sprintf("http://freegeoip.net/json/%s", $ip));

      if(!empty($payload))
      {
        $geoip = new GeoIP();
        $geoip->setIp($ip);
        $geoip->setJson($payload);

        $em->persist($geoip);
        $em->flush();

        return $geoip;
      }
      return null;
    }
    catch(\Exception $e)
    {
      return null;
    }
  }

  /**
   *
   */
  public function getLocationByAddress($address)
  {
    $this->logger->info(sprintf("Looking up address... (%s)", $address));

    try
    {
      $payload = $this->rest_client->get(sprintf("http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=%s", $address));
      $results = json_decode($payload, true);
      return $results;
    }
    catch(\Exception $e)
    {
      return null;
    }
  }

  /**
   *
   */
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

  /**
   *
   */
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

  /**
   *
   */
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

  /**
   *
   */
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
