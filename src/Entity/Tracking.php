<?php

namespace App\Entity;

use App\Repository\TrackingRepository;
use Carbon\Carbon;
use Carbon\Doctrine\CarbonType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrackingRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Tracking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $trackingNumber;

    /**
     * @ORM\Column(type="carbon")
     */
    private \DateTime $createdAt;

    /**
     * @ORM\Column(type="carbon")
     */
    private \DateTime $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(?string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    public function getCreatedAt(): CarbonType
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): CarbonType
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue(): void
    {
        $this->createdAt = Carbon::now();
        $this->setUpdatedAtValue();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = Carbon::now();
    }
}
