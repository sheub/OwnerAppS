<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 10:50
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class City
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\Doctrine\CityRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 * @Serializer\ExclusionPolicy("ALL")
 */
class City
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @Serializer\Expose
     */
    private $code = null;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     *
     * @Serializer\Expose
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", options={"unsigned"=true}, nullable=true)
     *
     * @Serializer\Expose
     */
    private $latitude = null;

    /**
     * @var string
     * @ORM\Column(type="string", options={"unsigned"=true}, nullable=true)
     *
     * @Serializer\Expose
     */
    private $longitude = null;

    /**
     * @var int
     * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=true)
     */
    private $inhabitants = null;

    /**
     * @var int
     * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=true)
     */
    private $density = null;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $active = false;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Station", mappedBy="city", cascade={"remove"})
     */
    private $stations;

    /**
     * Region constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->stations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return City
     */
    public function setId(int $id): City
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return City
     */
    public function setCode(?string $code): City
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return City
     */
    public function setName(string $name): City
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return City
     */
    public function setLatitude(?string $latitude): City
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return City
     */
    public function setLongitude(?string $longitude): City
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return int
     */
    public function getInhabitants(): ?int
    {
        return $this->inhabitants;
    }

    /**
     * @param int $inhabitants
     * @return City
     */
    public function setInhabitants(?int $inhabitants): City
    {
        $this->inhabitants = $inhabitants;
        return $this;
    }

    /**
     * @return int
     */
    public function getDensity(): ?int
    {
        return $this->density;
    }

    /**
     * @param int $density
     * @return City
     */
    public function setDensity(?int $density): City
    {
        $this->density = $density;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return City
     */
    public function setActive(bool $active): City
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return Collection
     */
    public function getStations(): Collection
    {
        return $this->stations;
    }

    /**
     * @param Station $station
     * @return City
     */
    public function addStation(Station $station): City
    {
        $this->stations->add($station);
        $station->setCity($this);
        return $this;
    }

    /**
     * @param Station $station
     * @return City
     */
    public function removeStation(Station $station): City
    {
        $this->stations->removeElement($station);
        $station->setCity(null);
        return $this;
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

}