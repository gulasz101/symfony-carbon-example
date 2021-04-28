<?php

declare(strict_types=1);

namespace App\Services\Tracking;

use App\Entity\Tracking;
use App\Repository\TrackingRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CleanupOldTrackings
 * @package App\Services\Tracking
 */
class CleanupOldTrackings
{
    private EntityManagerInterface $entityManager;

    /**
     * @required
     */
    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    public function deleteOldTrackings(): void
    {
        /** @var TrackingRepository $repository */
        $repository = $this->entityManager->getRepository(Tracking::class);

        $repository->createQueryBuilder('q')
            ->andWhere('q.created_at < :created_at')
            ->setParameter('created_at', Carbon::now()->subDays(30))
            ->getQuery()
            ->execute();
    }
}
