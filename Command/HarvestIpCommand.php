<?php
namespace Striide\GeoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HarvestIpCommand extends ContainerAwareCommand
{
  /**
   * @see Command
   */
  protected function configure()
  {
    $this->setName('striide:geoip:harvest')
      ->setDescription('Harvest IP Address GEO Data')
      ->setDefinition(array())
      ->setHelp(
<<<EOT
The <info>striide:geoip:harvest</info> command is for harvesting GEO Data from IP addresses
EOT
) ;
  }
  /**
   * @see Command
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    // just harvest 1 for now... 
    $this->harvest($output);
  }
  
  private function harvest($output)
  {
    $em = $this->getContainer()->get('doctrine.orm.entity_manager');
    $em->clear();
    
    $ip = $em->getRepository('StriideGeoBundle:GeoIpHarvesting')->findOldest();
    
    if(is_null($ip))
    {
      return;
    }
    
    $output->writeln(sprintf("... harvesting IP:%s", $ip->getIp()));
    
    $service = $this->getContainer()->get('striide_geo.geo.service');
    $service->harvestLocationByIp($ip->getIp());
    
    $output->writeln(sprintf("... harvested IP:%s", $ip->getIp()));
    
    $connection = $em->getConnection();
    $connection->exec("DELETE FROM striide_geo_ip_harvesting WHERE id = " .$ip->getId());
    $em->clear();
  }
}
