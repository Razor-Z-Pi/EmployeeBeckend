<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Monday;

    #[ORM\Column(type: 'string', length: 255)]
    private $Tuesday;

    #[ORM\Column(type: 'string', length: 255)]
    private $Wednesday;

    #[ORM\Column(type: 'string', length: 255)]
    private $Thursday;

    #[ORM\Column(type: 'string', length: 255)]
    private $Friday;

    #[ORM\Column(type: 'string', length: 255)]
    private $Saturday;

    #[ORM\Column(type: 'string', length: 255)]
    private $Sunday;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Description;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $idHistory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getMonday(): ?string
    {
        return $this->Monday;
    }

    public function setMonday(string $Monday): self
    {
        $this->Monday = $Monday;

        return $this;
    }

    public function getTuesday(): ?string
    {
        return $this->Tuesday;
    }

    public function setTuesday(string $Tuesday): self
    {
        $this->Tuesday = $Tuesday;

        return $this;
    }

    public function getWednesday(): ?string
    {
        return $this->Wednesday;
    }

    public function setWednesday(string $Wednesday): self
    {
        $this->Wednesday = $Wednesday;

        return $this;
    }

    public function getThursday(): ?string
    {
        return $this->Thursday;
    }

    public function setThursday(string $Thursday): self
    {
        $this->Thursday = $Thursday;

        return $this;
    }

    public function getFriday(): ?string
    {
        return $this->Friday;
    }

    public function setFriday(string $Friday): self
    {
        $this->Friday = $Friday;

        return $this;
    }

    public function getSaturday(): ?string
    {
        return $this->Saturday;
    }

    public function setSaturday(string $Saturday): self
    {
        $this->Saturday = $Saturday;

        return $this;
    }

    public function getSunday(): ?string
    {
        return $this->Sunday;
    }

    public function setSunday(string $Sunday): self
    {
        $this->Sunday = $Sunday;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getIdHistory(): ?int
    {
        return $this->idHistory;
    }

    public function setIdHistory(?int $idHistory): self
    {
        $this->idHistory = $idHistory;

        return $this;
    }

    public function toArray() : array
    {
        return [
            "id" => $this-> id,
            "Name" => $this -> Name,
            "Monday" => $this-> Monday,
            "Tuesday" => $this -> Tuesday,
            "Wednesday" => $this -> Wednesday,
            "Thursday" => $this -> Thursday,
            "Friday" => $this -> Friday,
            "Saturday" => $this -> Saturday,
            "Sunday" => $this -> Sunday,
            "Description" => $this -> Description
        ];
    }
}
