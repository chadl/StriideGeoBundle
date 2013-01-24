<?php
namespace Striide\GeoBundle\Service;

class GoogleGeoService
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
   *
   */
  public function getLocationByIpAddress($address)
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
}
