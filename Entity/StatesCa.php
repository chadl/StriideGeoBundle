<?php
namespace Striide\GeoBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Striide\GeoBundle\Entity\StatesCa
 */

class StatesCa
{
  /**
   * @var integer $id
   */
  private $id;
  /**
   * @var string $shortCode
   */
  private $shortCode;
  /**
   * @var string $name
   */
  private $name;
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
   * Set shortCode
   *
   * @param string $shortCode
   */
  public function setShortCode($shortCode) 
  {
    $this->shortCode = $shortCode;
  }
  /**
   * Get shortCode
   *
   * @return string
   */
  public function getShortCode() 
  {
    return $this->shortCode;
  }
  /**
   * Set name
   *
   * @param string $name
   */
  public function setName($name) 
  {
    $this->name = $name;
  }
  /**
   * Get name
   *
   * @return string
   */
  public function getName() 
  {
    return $this->name;
  }
}
