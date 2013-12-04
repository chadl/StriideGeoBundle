<?php
namespace Striide\GeoBundle\Service;

use Striide\GeoBundle\Entity\GeoIP;
use Striide\GeoBundle\Entity\GeoIpHarvesting;

class GeoService
{
  /**
   *
   */
  private $logger = null;
  
  /**
   *
   */
  public function setLogger($logger)
  {
    $this->logger = $logger;
  }
  
  /**
   *
   */
  private $em = null;

  /**
   *
   */
  public function setEntityManager($e)
  {
    $this->em = $e;
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
   * queue the record to harvest
   */
  public function queueHarvest($ip)
  {
    $this->logger->info(__METHOD__,array($ip));
    
    // only harvest if we need to
    $geoip = $this->em->getRepository('StriideGeoBundle:GeoIP')->findOneByIp($ip);
    if(!empty($geoip))
    {
      return;
    }
    
    $geoip = $this->em->getRepository('StriideGeoBundle:GeoIpHarvesting')->findOneBy(array('ip' => $ip));
    if(!empty($geoip))
    {
      return;
    }
    
    $harvest = new GeoIpHarvesting();
    $harvest->setIp($ip);
    
    $this->em->persist($harvest);
    $this->em->flush();
    $this->em->clear();
  }
  
  /**
   * @param string $ip
   * @return null
   */
  public function harvestLocationByIp($ip)
  {
    $this->logger->info(__METHOD__,array($ip));
    
    $geoip = $this->em->getRepository('StriideGeoBundle:GeoIP')->findOneByIp($ip);
    if(!empty($geoip))
    {
      return $geoip;
    }
    
    try
    {
      $payload = $this->rest_client->get(sprintf("http://freegeoip.net/json/%s", $ip));
    }
    catch(\Exception $e)
    {
      return null;
    }
    
    if(!empty($payload))
    {
      $geoip = new GeoIP();
      $geoip->setIp($ip);
      $geoip->setJson($payload);

      $this->em->persist($geoip);
      $this->em->flush();
      $this->em->clear();

      return $geoip;
    }
    
    return null;
  }

  /**
   * @return GeoIP
   */
  public function getLocationByIp($ip)
  {
    $this->logger->info(sprintf("Looking up address by ip... (%s)",$ip));

    $geoip = $this->em->getRepository('StriideGeoBundle:GeoIP')->findOneByIp($ip);
    if(!empty($geoip))
    {
      return $geoip;
    }
    else
    {
      // queue harvesting....
      $this->queueHarvest($ip);
    }
    return null;
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
    $repository = $this->em->getRepository('StriideGeoBundle:Countries');
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
    $repository = $this->em->getRepository('StriideGeoBundle:StatesUs');
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
    $repository = $this->em->getRepository('StriideGeoBundle:StatesCa');
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
