<?php
namespace Striide\GeoBundle\Factory;
use Striide\GeoBundle\Entity\PostalCode;
/**
 * Striide\GeoBundle\Factory\PostalCodeFactory
 */

class PostalCodeFactory
{
  private function __construct() 
  {
  }
  public static function createInstance() 
  {
    return new PostalCodeFactory();
  }
  public function createFromGoogleLocation($code, $location) 
  {
    $pc = new PostalCode();
    $pc->setCode($code);
    
    if (isset($location['results']) && isset($location['results'][0]) && isset($location['results'][0]['geometry']) && isset($location['results'][0]['geometry']['location'])) 
    {
      $geometry = $location['results'][0]['geometry']['location'];
      
      if (isset($geometry['lat'])) 
      {
        $pc->setLat($geometry['lat']);
      }
      
      if (isset($geometry['lng'])) 
      {
        $pc->setLng($geometry['lng']);
      }
    }
    else
    {
      return null;
    }
    $pc->setSerialized(serialize($location));
    return $pc;
  }
}
