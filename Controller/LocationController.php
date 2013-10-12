<?php
namespace Striide\GeoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LocationController extends Controller
{
  /**
   * @Route("/geo/states.{_format}", name="StriideGeoBundle_get_states", defaults={ "_format" = "json"})
   */
  public function statesAction()
  {
    $states = $this->get('striide_geo.geo.service')->getStatesArray();
    return new Response(json_encode($states));
  }

  /**
   * @Route("/geo/provinces.{_format}", name="StriideGeoBundle_get_provinces", defaults={ "_format" = "json"})
   */
  public function provincesAction()
  {
    $provinces = $this->get('striide_geo.geo.service')->getProvincesArray();
    return new Response(json_encode($provinces));
  }
}
