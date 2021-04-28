<?php

declare(strict_types=1);

namespace App\Services\Tracking;

use App\Entity\Tracking;
use App\Repository\TrackingRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CleanupOldTrackingsService
 * @package App\Services\Tracking
 */
class CleanupOldTrackingsService
{
    public const MAX_TRACKING_AGE_IN_DAYS = 30;

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
            ->delete()
            ->andWhere('q.createdAt < :createdAt')
            ->setParameter(
                ':createdAt',
                Carbon::now()->subDays(self::MAX_TRACKING_AGE_IN_DAYS)
            )
            ->getQuery()
            ->execute();
    }
}
