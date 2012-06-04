<?php
namespace Striide\GeoBundle\Entity;
use Doctrine\ORM\EntityRepository;

class StatesUsRepository extends EntityRepository
{
  /**
   *
   */
  public function getArray() 
  {
    $query = $this->getEntityManager()->createQuery('
					SELECT c
					FROM Striide\GeoBundle\Entity\StatesUs c
					ORDER BY c.id ASC
				');
    try
    {
      $countries = $query->getResult();
      return $countries;
    }
    catch(\Doctrine\ORM\NoResultException $e) 
    {
      return null;
    }
  }
}
