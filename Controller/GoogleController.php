<?php
namespace Striide\GeoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class GoogleController extends Controller
{
  /**
   * @Route("/geo/google/api", name="StriideGeoBundle_google_api")
   * @Template()
   */
  public function apiAction()
  {
    return new Response('<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>');
  }
}
