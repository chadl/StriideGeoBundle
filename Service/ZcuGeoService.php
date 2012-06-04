<?php
namespace Striide\GeoBundle\Service;
use Striide\GeoBundle\Factory\PostalCodeFactory;

class ZcuGeoService
{
  private $logger = null;
  private $doctrine = null;
  public function __construct($doctrine, $logger) 
  {
    $this->logger = $logger;
    $this->doctrine = $doctrine;
  }
  public function getLocationByZipCode($zipcode) 
  {
    $this->logger->info(sprintf("ZcuGeoService::getLocationByZipCode(%s)", $zipcode));
    
    if (!is_numeric($zipcode)) 
    {
      $zipcode = str_replace(" ", "", $zipcode);
      $zipcode = substr($zipcode, 0, 3) . " " . substr($zipcode, 3, 3);
    }
    $em = $this->doctrine->getEntityManager();
    $repository = $em->getRepository("StriideGeoBundle:Zcu");
    $zcu = $repository->findZcuArrayByZip($zipcode);
    return $zcu;
  }
}
