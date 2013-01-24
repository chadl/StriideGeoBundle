<?php
namespace Striide\GeoBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Striide\GeoBundle\Entity\PostalCode
 */

class PostalCode
{
  /**
   * @var integer $id
   */
  private $id;
  /**
   * @var string $code
   */
  private $code;
  /**
   * @var float $lat
   */
  private $lat;
  /**
   * @var float $lng
   */
  private $lng;
  /**
   * @var text $serialized
   */
  private $serialized;
  /**
   * Get id
   *
   * @return integer
   */
  public function getId() 
  {
    return $this->id;
  }
  /**
   * Set code
   *
   * @param string $code
   */
  public function setCode($code) 
  {
    $this->code = $code;
  }
  /**
   * Get code
   *
   * @return string
   */
  public function getCode() 
  {
    return $this->code;
  }
  /**
   * Set lat
   *
   * @param float $lat
   */
  public function setLat($lat) 
  {
    $this->lat = $lat;
  }
  /**
   * Get lat
   *
   * @return float
   */
  public function getLat() 
  {
    return $this->lat;
  }
  /**
   * Set lng
   *
   * @param float $lng
   */
  public function setLng($lng) 
  {
    $this->lng = $lng;
  }
  /**
   * Get lng
   *
   * @return float
   */
  public function getLng() 
  {
    return $this->lng;
  }
  /**
   * Set serialized
   *
   * @param text $serialized
   */
  public function setSerialized($serialized) 
  {
    $this->serialized = $serialized;
  }
  /**
   * Get serialized
   *
   * @return text
   */
  public function getSerialized() 
  {
    return $this->serialized;
  }
}