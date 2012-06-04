<?php
namespace Striide\GeoBundle\Model;
/**
 * Striide\GeoBundle\Model\Timezone
 */

class Timezone
{
  private $offset = null;
  public function setOffset($offset) 
  {
    $this->offset = $offset;
  }
  public function getOffset() 
  {
    return $this->offset;
  }
  private $php_name = null;
  public function setPhpname($name) 
  {
    $this->php_name = $name;
  }
  public function getPhpname() 
  {
    return $this->php_name;
  }
}
