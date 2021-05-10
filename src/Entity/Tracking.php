<?php

namespace App\Entity;

use App\Repository\TrackingRepository;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
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
	private CarbonImmutable $createdAt;

	/**
	 * @ORM\Column(type="carbon")
	 */
	private CarbonImmutable $updatedAt;

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

	public function getCreatedAt(): CarbonImmutable
	{
		return $this->createdAt;
	}

	public function setCreatedAt(CarbonImmutable $createdAt): self
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	public function getUpdatedAt(): CarbonImmutable
	{
		return $this->updatedAt;
	}

	public function setUpdatedAt(CarbonImmutable $updatedAt): self
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}

	/**
	 * @ORM\PrePersist
	 */
	public function setCreatedAtValue(): void
	{
		$this->createdAt = Carbon::now()->toImmutable();
		$this->setUpdatedAtValue();
	}

	/**
	 * @ORM\PreUpdate()
	 */
	public function setUpdatedAtValue(): void
	{
		$this->updatedAt = Carbon::now()->toImmutable();
	}
}
