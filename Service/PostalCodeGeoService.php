<?php
namespace Striide\GeoBundle\Service;
use Striide\GeoBundle\Factory\PostalCodeFactory;

class PostalCodeGeoService
{
  private $logger = null;
  private $doctrine = null;
  public function __construct($doctrine, $logger)
  {
    $this->logger = $logger;
    $this->doctrine = $doctrine;
  }
  private $geocoder_service = null;
  public function setGeoCoderService($service)
  {
    $this->geocoder_service = $service;
  }
  public function getLocationByPostalCode($postalcode)
  {
    $this->logger->info(sprintf("Looking up postalcode... (%s)", $postalcode));
    $em = $this->doctrine->getEntityManager();
    $repository = $em->getRepository("StriideGeoBundle:PostalCode");
    $pc = $repository->findOneBy(array(
      'code' => $postalcode
    ));

    if (empty($pc))
    {
      $location = $this->geocoder_service->getLocationByAddress($postalcode);
      
      $pc = PostalCodeFactory::createInstance()->createFromGoogleLocation($postalcode, $location);

      if (is_null($pc))
      {
        $this->logger->err(sprintf("Failed to read lat/lng location, postalcode:(%s), results:(%s)", $postalcode, json_encode($location)));
        return $pc;
      }
      try
      {
        $em->persist($pc);
        $em->flush();
        return $pc;
      }
      catch(\Exception $e)
      {
        $this->logger->err(sprintf("Failed to save new postalcode... (%s), exception was: %s", $postalcode, $e->getMessage()));
      }
    }
    return $pc;
  }
}
