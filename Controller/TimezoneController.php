<?php
namespace Striide\GeoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class TimezoneController extends Controller
{
  /**
   * @Route("/geo/timezone/offset", name="striide_geo_timezone_offset")
   * @Template()
   */
  public function offsetAction() 
  {
    $offset = $this->get('request')->query->get('offset');
    $tz = $this->get('striide_geo.timezone.service')->getTimezoneByOffset($offset);
    //$response = new Response(json_encode(array('timezone' => $tz->getPhpname() )));
    $response = new Response(sprintf("{'tz':'%s'}", $tz->getPhpname()));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }
}
