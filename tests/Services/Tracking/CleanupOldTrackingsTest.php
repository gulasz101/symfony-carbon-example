<?php

declare(strict_types=1);

namespace App\Tests\Services\Tracking;

use App\Entity\Tracking;
use App\Services\Tracking\CleanupOldTrackingsService;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator as Faker;
use RachidLaasri\Travel\Travel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CleanupOldTrackingsTest extends KernelTestCase
{
    private Faker $faker;
    private CleanupOldTrackingsService $cleanupOldTrackingsService;
    private EntityManagerInterface $em;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();

        $this->faker = Factory::create();

        $this->cleanupOldTrackingsService = self::$container->get(CleanupOldTrackingsService::class);
        $this->em = self::$container->get(EntityManagerInterface::class);
    }


    public function testDeleteOnlyTrackingOlderThanMaxAge(): void
    {
        Travel::to(
            Carbon::now()->subDays(CleanupOldTrackingsService::MAX_TRACKING_AGE_IN_DAYS + 1),
            function (): void {
                $this->factoryTracking();
            }
        );

        $this->factoryTracking();

        $this->cleanupOldTrackingsService->deleteOldTrackings();

        $this->assertCount(1, $this->em->getRepository(Tracking::class)->findAll());
    }

    private function factoryTracking(): void
    {
        $tracking = new Tracking();
        $tracking->setTrackingNumber($this->faker->uuid());

        $this->em->persist($tracking);
        $this->em->flush();
    }
}
