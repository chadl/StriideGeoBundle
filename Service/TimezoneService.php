<?php
namespace Striide\GeoBundle\Service;
use Striide\GeoBundle\Model\Timezone;

class TimezoneService
{
  private $logger = null;
  public function __construct($logger)
  {
    $this->logger = $logger;
  }
  private $rest_client = null;
  public function setRestClient($client)
  {
    $this->rest_client = $client;
  }
  private $postal_service = null;
  public function setPostalService($service)
  {
    $this->postal_service = $service;
  }
  /**
   * in Javascript you can get the offset using:
   *
   * @param int $offset the offset in hours
   * @return \Striide\GeoBundle\Model\Timezone timezone
   */
  public function getTimezoneByOffset($offset)
  {
    $tz = new Timezone();
    $tz->setOffset($offset);
    $tz->setPhpName(timezone_name_from_abbr("", $offset * 3600, 0));
    return $tz;
  }

  /**
   * @param string $timezone_string (which may or may not be php timezone string)
   * @return DateTimeZone php representation of a timezone string
   */
  public function getDateTimeZoneFromTimezoneString($timezone_string)
  {
    // need some way to automagicaly convert these?
    $zone = new \DateTimeZone($timezone_string);
    return $zone;
  }
  /**
   * Get the timezone based on the lat/lng
   * @param float $lat latitude
   * @param float $lng longitude
   * @return \Striide\GeoBundle\Model\Timezone timezone
   */
  public function getTimezoneByLatLng($lat, $lng)
  {
    $this->logger->info(sprintf("Looking up timezone by lat/long ...(%s/%s)", $lat, $lng));
    $payload = $this->rest_client->get(sprintf("http://www.earthtools.org/timezone/%s/%s", $lat, $lng));
    $timezone = new SimpleXMLElement($payload);

    if (!is_null($timezone))
    {
      $tz = $this->getTimezoneByOffset((int)$timezone->offset);
      return $tz;
    }
    return null;
  }
  /**
   * Get the timezone based on the postalcode
   * @param string $code postalcode
   * @return \Striide\GeoBundle\Model\Timezone timezone
   */
  public function getTimezoneByPostalCode($code)
  {
    $this->logger->info(sprintf("Looking up lat/lng by postal code ... (%s)", $code));
    $pc = $this->postal_service->getLocationByPostalCode($code);

    if (is_null($pc))
    {
      return null;
    }
    $tz = $this->getTimezoneByLatLng($pc->getLat() , $pc->getLng());
    return $tz;
  }
  public function getTimezones()
  {
    $zones = array();
    $zones[] = "Africa/Algiers";
    $zones[] = "Africa/Cairo";
    $zones[] = "Africa/Casablanca";
    $zones[] = "Africa/Harare";
    $zones[] = "Africa/Johannesburg";
    $zones[] = "Africa/Nairobi";
    $zones[] = "Africa/Windhoek";
    $zones[] = "America/Adak";
    $zones[] = "America/Bogota";
    $zones[] = "America/Caracas";
    $zones[] = "America/Godthab";
    $zones[] = "America/Guatemala";
    $zones[] = "America/Indiana/Petersburg";
    $zones[] = "America/Mazatlan";
    $zones[] = "America/Montevideo";
    $zones[] = "America/Noronha";
    $zones[] = "America/Phoenix";
    $zones[] = "America/Santiago";
    $zones[] = "America/Sao_Paulo";
    $zones[] = "America/St_Johns";
    $zones[] = "Asia/Almaty";
    $zones[] = "Asia/Baku";
    $zones[] = "Asia/Bangkok";
    $zones[] = "Asia/Calcutta";
    $zones[] = "Asia/Colombo";
    $zones[] = "Asia/Dubai";
    $zones[] = "Asia/Irkutsk";
    $zones[] = "Asia/Kabul";
    $zones[] = "Asia/Karachi";
    $zones[] = "Asia/Katmandu";
    $zones[] = "Asia/Kolkata";
    $zones[] = "Asia/Krasnoyarsk";
    $zones[] = "Asia/Kuala_Lumpur";
    $zones[] = "Asia/Magadan";
    $zones[] = "Asia/Rangoon";
    $zones[] = "Asia/Riyadh";
    $zones[] = "Asia/Shanghai";
    $zones[] = "Asia/Singapore";
    $zones[] = "Asia/Taipei";
    $zones[] = "Asia/Tehran";
    $zones[] = "Asia/Tel_Aviv";
    $zones[] = "Asia/Tokyo";
    $zones[] = "Asia/Vladivostok";
    $zones[] = "Asia/Yakutsk";
    $zones[] = "Asia/Yekaterinburg";
    $zones[] = "Atlantic/Azores";
    $zones[] = "Atlantic/Cape_Verde";
    $zones[] = "Australia/Adelaide";
    $zones[] = "Australia/Brisbane";
    $zones[] = "Australia/Brisbane  ";
    $zones[] = "Australia/Darwin";
    $zones[] = "Australia/Lord_Howe";
    $zones[] = "Australia/Melbourne";
    $zones[] = "Australia/Perth";
    $zones[] = "Australia/Sydney";
    $zones[] = "Canada/Atlantic";
    $zones[] = "Canada/Saskatchewan";
    $zones[] = "Europe/Amsterdam";
    $zones[] = "Europe/Athens";
    $zones[] = "Europe/Berlin";
    $zones[] = "Europe/Brussels";
    $zones[] = "Europe/Bucharest";
    $zones[] = "Europe/Copenhagen";
    $zones[] = "Europe/Dublin";
    $zones[] = "Europe/Helsinki";
    $zones[] = "Europe/Istanbul";
    $zones[] = "Europe/Lisbon";
    $zones[] = "Europe/Ljubljana";
    $zones[] = "Europe/London";
    $zones[] = "Europe/Madrid";
    $zones[] = "Europe/Moscow";
    $zones[] = "Europe/Paris";
    $zones[] = "Europe/Rome";
    $zones[] = "Europe/Stockholm";
    $zones[] = "Europe/Tallinn";
    $zones[] = "Europe/Warsaw";
    $zones[] = "Europe/Zurich";
    $zones[] = "Pacific/Auckland";
    $zones[] = "Pacific/Chatham";
    $zones[] = "Pacific/Easter";
    $zones[] = "Pacific/Enderbury";
    $zones[] = "Pacific/Fiji";
    $zones[] = "Pacific/Gambier";
    $zones[] = "Pacific/Guadalcanal";
    $zones[] = "Pacific/Honolulu";
    $zones[] = "Pacific/Kiritimati";
    $zones[] = "Pacific/Marquesas";
    $zones[] = "Pacific/Midway";
    $zones[] = "Pacific/Norfolk";
    $zones[] = "Pacific/Pitcairn";
    $zones[] = "Pacific/Tahiti";
    $zones[] = "US/Alaska";
    $zones[] = "US/Arizona";
    $zones[] = "US/Central";
    $zones[] = "US/Eastern";
    $zones[] = "US/Mountain";
    $zones[] = "US/Pacific";


    $select_zones = array();
    sort($zones);
    foreach ($zones as $z)
    {
      $select_zones[$z] = $z;
    }
    return $select_zones;
  }
}
