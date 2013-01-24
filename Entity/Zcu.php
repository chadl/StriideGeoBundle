<?php
namespace Striide\GeoBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Striide\GeoBundle\Entity\Zcu
 */

class Zcu
{
  /**
   * @var string $zip
   */
  private $zip;
  /**
   * @var string $city
   */
  private $city;
  /**
   * @var string $st
   */
  private $st;
  /**
   * @var string $ac
   */
  private $ac;
  /**
   * @var string $county
   */
  private $county;
  /**
   * @var string $tz
   */
  private $tz;
  /**
   * @var string $dst
   */
  private $dst;
  /**
   * @var string $country
   */
  private $country;
  /**
   * @var string $type
   */
  private $type;
  /**
   * @var string $pref
   */
  private $pref;
  /**
   * @var string $fips
   */
  private $fips;
  /**
   * Set zip
   *
   * @param string $zip
   */
  public function setZip($zip) 
  {
    $this->zip = $zip;
  }
  /**
   * Get zip
   *
   * @return string
   */
  public function getZip() 
  {
    return $this->zip;
  }
  /**
   * Set city
   *
   * @param string $city
   */
  public function setCity($city) 
  {
    $this->city = $city;
  }
  /**
   * Get city
   *
   * @return string
   */
  public function getCity() 
  {
    return $this->city;
  }
  /**
   * Set st
   *
   * @param string $st
   */
  public function setSt($st) 
  {
    $this->st = $st;
  }
  /**
   * Get st
   *
   * @return string
   */
  public function getSt() 
  {
    return $this->st;
  }
  /**
   * Set ac
   *
   * @param string $ac
   */
  public function setAc($ac) 
  {
    $this->ac = $ac;
  }
  /**
   * Get ac
   *
   * @return string
   */
  public function getAc() 
  {
    return $this->ac;
  }
  /**
   * Set county
   *
   * @param string $county
   */
  public function setCounty($county) 
  {
    $this->county = $county;
  }
  /**
   * Get county
   *
   * @return string
   */
  public function getCounty() 
  {
    return $this->county;
  }
  /**
   * Set tz
   *
   * @param string $tz
   */
  public function setTz($tz) 
  {
    $this->tz = $tz;
  }
  /**
   * Get tz
   *
   * @return string
   */
  public function getTz() 
  {
    return $this->tz;
  }
  /**
   * Set dst
   *
   * @param string $dst
   */
  public function setDst($dst) 
  {
    $this->dst = $dst;
  }
  /**
   * Get dst
   *
   * @return string
   */
  public function getDst() 
  {
    return $this->dst;
  }
  /**
   * Set country
   *
   * @param string $country
   */
  public function setCountry($country) 
  {
    $this->country = $country;
  }
  /**
   * Get country
   *
   * @return string
   */
  public function getCountry() 
  {
    return $this->country;
  }
  /**
   * Set type
   *
   * @param string $type
   */
  public function setType($type) 
  {
    $this->type = $type;
  }
  /**
   * Get type
   *
   * @return string
   */
  public function getType() 
  {
    return $this->type;
  }
  /**
   * Set pref
   *
   * @param string $pref
   */
  public function setPref($pref) 
  {
    $this->pref = $pref;
  }
  /**
   * Get pref
   *
   * @return string
   */
  public function getPref() 
  {
    return $this->pref;
  }
  /**
   * Set fips
   *
   * @param string $fips
   */
  public function setFips($fips) 
  {
    $this->fips = $fips;
  }
  /**
   * Get fips
   *
   * @return string
   */
  public function getFips() 
  {
    return $this->fips;
  }
}