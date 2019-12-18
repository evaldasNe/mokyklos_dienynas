<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObservationRepository")
 */
class Observation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $teacher;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $observationText;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addressee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeacher(): ?string
    {
        return $this->teacher;
    }

    public function setTeacher(string $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getObservationText(): ?string
    {
        return $this->observationText;
    }

    public function setObservationText(string $observationText): self
    {
        $this->observationText = $observationText;

        return $this;
    }

    public function getAddressee(): ?string
    {
        return $this->addressee;
    }

    public function setAddressee(string $addressee): self
    {
        $this->addressee = $addressee;

        return $this;
    }
}
