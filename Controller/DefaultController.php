<?php
namespace Striide\GeoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
  /**
   * @Route("/geo/postalcode/{code}", name="StriideGeoBundle_postalcode")
   * @Template()
   */
  public function postalcodeAction($code)
  {
    $pc = $this->get('striide_geo.postalcode.service')->getLocationByPostalCode($code);
    return array(
      'code' => $code,
      'pc' => $pc
    );
  }

  /**
   * @Route("/zcu/zipcode", name="StriideGeoBundle_zip")
   * @Template()
   */
  public function zipcodeAction()
  {
    $code = $this->get('request')->query->get('zipcode');

    if (empty($code))
    {
      return new Response(json_encode(array(
        'status' => false,
        'message' => 'missing zipcode'
      )));
    }
    $zcu = $this->get('striide_geo.zcu.service')->getLocationByZipcode($code);

    if (empty($zcu))
    {
      return new Response(json_encode(array(
        'status' => false,
        'message' => 'zipcode not found'
      )));
    }
    return new Response(json_encode(array(
      'code' => $code,
      'zcu' => $zcu
    )));
  }
}
