<?php
namespace Striide\GeoBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Striide\GeoBundle\Entity\StatesUs;

class LoadStatesUsData extends AbstractFixture implements OrderedFixtureInterface
{
  private function setState($manager,$code,$name)
  {
    $province = new StatesUs();
    $province->setShortCode($code);
    $province->setName($name);
    $manager->persist($province);
  }
  public function load(ObjectManager $manager)
  {
    $this->setState($manager,"AL","Alabama");
    $this->setState($manager,"AK","Alaska");
    $this->setState($manager,"AS","AMERICAN SAMOA");
    $this->setState($manager,"AZ","Arizona");
    $this->setState($manager,"AR","Arkansas");
    $this->setState($manager,"CA","California");
    $this->setState($manager,"CO","Colorado");
    $this->setState($manager,"CT","Connecticut");
    $this->setState($manager,"DE","Delaware");
    $this->setState($manager,"DC","District Of Columbia");
    $this->setState($manager,"FM","FEDERATED STATES OF MICRONESIA");
    $this->setState($manager,"FL","Florida");
    $this->setState($manager,"GA","Georgia");
    $this->setState($manager,"GU","GUAM");
    $this->setState($manager,"HI","Hawaii");
    $this->setState($manager,"ID","Idaho");
    $this->setState($manager,"IL","Illinois");
    $this->setState($manager,"IN","Indiana");
    $this->setState($manager,"IA","Iowa");
    $this->setState($manager,"KS","Kansas");
    $this->setState($manager,"KY","Kentucky");
    $this->setState($manager,"LA","Louisiana");
    $this->setState($manager,"ME","Maine");
    $this->setState($manager,"MH","MARSHALL ISLANDS");
    $this->setState($manager,"MD","Maryland");
    $this->setState($manager,"MA","Massachusetts");
    $this->setState($manager,"MI","Michigan");
    $this->setState($manager,"MN","Minnesota");
    $this->setState($manager,"MS","Mississippi");
    $this->setState($manager,"MO","Missouri");
    $this->setState($manager,"MT","Montana");
    $this->setState($manager,"NE","Nebraska");
    $this->setState($manager,"NV","Nevada");
    $this->setState($manager,"NH","New Hampshire");
    $this->setState($manager,"NJ","New Jersey");
    $this->setState($manager,"NM","New Mexico");
    $this->setState($manager,"NY","New York");
    $this->setState($manager,"NC","North Carolina");
    $this->setState($manager,"ND","North Dakota");
    $this->setState($manager,"MP","NORTHERN MARIANA ISLANDS");
    $this->setState($manager,"OH","Ohio");
    $this->setState($manager,"OK","Oklahoma");
    $this->setState($manager,"OR","Oregon");
    $this->setState($manager,"PW","PALAU");
    $this->setState($manager,"PA","Pennsylvania");
    $this->setState($manager,"PR","PUERTO RICO");
    $this->setState($manager,"RI","Rhode Island");
    $this->setState($manager,"SC","South Carolina");
    $this->setState($manager,"SD","South Dakota");
    $this->setState($manager,"TN","Tennessee");
    $this->setState($manager,"TX","Texas");
    $this->setState($manager,"UT","Utah");
    $this->setState($manager,"VT","Vermont");
    $this->setState($manager,"VI","VIRGIN ISLANDS");
    $this->setState($manager,"VA","Virginia");
    $this->setState($manager,"WA","Washington");
    $this->setState($manager,"WV","West Virginia");
    $this->setState($manager,"WI","Wisconsin");
    $this->setState($manager,"WY","Wyoming");

    $manager->flush();
  }
  public function getOrder()
  {
    return 1;
  }
}
