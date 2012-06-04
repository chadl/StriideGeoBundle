StriideGeoBundle
================

The intent with this bundle is to expose convenient ways to harvest and provide
geo data from third parties and use this geo data locally in your app.

Services
--------

* striide_geo.zcu.service
** getLocationByZipCode
* striide_geo.postalcode.service
** getLocationByPostalCode
* striide_geo.geo.service
* striide_geo.timezone.service
** getTimezoneByOffset
** getDateTimeZoneFromTimezoneString
** getTimezoneByLatLng
** getTimezoneByPostalCode
** getTimezones


Routing
-------

StriideGeoBundle:
    resource: "@StriideGeoBundle/Controller/"
    type:     annotation
    prefix:   /
