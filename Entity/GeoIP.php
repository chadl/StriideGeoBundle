<?php

namespace Striide\GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoIP
 */
class GeoIP
{
    /**
     * @var integer
     */
    private $ip;

    /**
     * @var string
     */
    private $json;


    /**
     * Get ip
     *
     * @return integer
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set json
     *
     * @param string $json
     * @return GeoIP
     */
    public function setJson($json)
    {
        $this->json = $json;

        return $this;
    }

    /**
     * Get json
     *
     * @return string
     */
    public function getJson()
    {
        return $this->json;
    }

    public function getData()
    {
        if(!empty($this->json))
        {
            return json_decode($this->json,true);
        }
        return array();
    }

    public function getCountry()
    {
        $data = $this->getData();

        if(isset($data['country_name']))
        {
            return $data['country_name'];
        }
        return null;
    }

    /**
     * @var integer
     */
    private $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return GeoIP
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }
}
