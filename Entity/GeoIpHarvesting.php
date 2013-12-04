<?php

namespace Striide\GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoIpHarvesting
 */
class GeoIpHarvesting
{
  /**
   * @var integer
   */
  protected $id;

  /**
   * @var string
   */
  protected $ip;

  /**
   * @var \DateTime
   */
  protected $createdAt;


  public function __construct()
  {
    $datetime = new \DateTime();
    $datetime->setTimezone(new \DateTimeZone('UTC'));

    $this->setCreatedAt($datetime);$this->createdAt = $datetime;
  }
  
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
   * Set ip
   *
   * @param string $ip
   * @return GeoIpHarvesting
   */
  public function setIp($ip)
  {
    $this->ip = $ip;

    return $this;
  }

  /**
   * Get ip
   *
   * @return string 
   */
  public function getIp()
  {
    return $this->ip;
  }

  /**
   * Set createdAt
   *
   * @param \DateTime $createdAt
   * @return GeoIpHarvesting
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * Get createdAt
   *
   * @return \DateTime 
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }
}