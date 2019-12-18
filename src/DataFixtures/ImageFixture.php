<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ImageFixture extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 200; ++$i) {
            $image = new Image();

            $image->setName(sprintf('image%s.png', $i))
                ->setFolder($this->faker->imageUrl())
            ;

            //TODO: get reference from ProductFixture.
            $manager->persist($image);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [ProductFixture::class];
    }
}
