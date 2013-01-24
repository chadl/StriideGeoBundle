<?php
namespace Striide\GeoBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Striide\GeoBundle\Entity\StatesCa;

class LoadStatCaData extends AbstractFixture implements OrderedFixtureInterface
{
  private function saveProvince($manager, $code,$name)
  {
    $province = new StatesCa();
    $province->setShortCode($code);
    $province->setName($name);
    $manager->persist($province);
  }
  public function load(ObjectManager $manager)
  {
    $this->saveProvince($manager,"AB","Alberta");
    $this->saveProvince($manager,"BC","British Columbia");
    $this->saveProvince($manager,"MB","Manitoba");
    $this->saveProvince($manager,"NB","New Brunswick");
    $this->saveProvince($manager,"NL","Newfoundland");
    $this->saveProvince($manager,"NT","Northwest Territories");
    $this->saveProvince($manager,"NS","Nova Scotia");
    $this->saveProvince($manager,"NU","Nunavut");
    $this->saveProvince($manager,"ON","Ontario");
    $this->saveProvince($manager,"PE","Prince Edward Island");
    $this->saveProvince($manager,"QC","Quebec");
    $this->saveProvince($manager,"SK","Saskatchewan");
    $this->saveProvince($manager,"YT","Yukon");
    $manager->flush();
  }
  public function getOrder()
  {
    return 1;
  }
}
