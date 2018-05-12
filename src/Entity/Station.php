<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 10:52
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Station
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\Doctrine\StationRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class Station
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
     */
    private $code = null;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description = null;

    /**
     * @var float
     * @ORM\Column(type="float", options={"unsigned"=true}, nullable=true)
     */
    private $latitude = null;

    /**
     * @var float
     * @ORM\Column(type="float", options={"unsigned"=true}, nullable=true)
     */
    private $longitude = null;

    /**
     * @var int
     * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=true)
     */
    private $bikesCapacity = null;
    
    /**
     * @var int
     * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=true)
     */
    private $bikesAvailable = null;

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
     * @var City
     * @ORM\ManyToOne(targetEntity="\App\Entity\City", inversedBy="stations")
     */
    private $city;

    /**
     * Station constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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
     * @return Station
     */
    public function setId(int $id): Station
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
     * @return Station
     */
    public function setCode(?string $code): Station
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
     * @return Station
     */
    public function setName(string $name): Station
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Station
     */
    public function setAddress(string $address): Station
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Station
     */
    public function setDescription(string $description): Station
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return Station
     */
    public function setLatitude(?float $latitude): Station
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return Station
     */
    public function setLongitude(?float $longitude): Station
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return int
     */
    public function getBikesCapacity(): ?int
    {
        return $this->bikesCapacity;
    }

    /**
     * @param int $bikesCapacity
     * @return Station
     */
    public function setBikesCapacity(?int $bikesCapacity): Station
    {
        $this->bikesCapacity = $bikesCapacity;
        return $this;
    }

    /**
     * @return int
     */
    public function getBikesAvailable(): ?int
    {
        return $this->bikesAvailable;
    }

    /**
     * @param int $bikesAvailable
     * @return Station
     */
    public function setBikesAvailable(?int $bikesAvailable): Station
    {
        $this->bikesAvailable = $bikesAvailable;
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
     * @return Station
     */
    public function setActive(bool $active): Station
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
     * @return City
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return Station
     */
    public function setCity(?City $city): Station
    {
        $this->city = $city;
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