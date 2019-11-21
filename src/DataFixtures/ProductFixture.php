<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixture extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */

    public static function getReferenceKey(int $number): string
    {
        return sprintf('product-%s', $number);
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 50; ++$i) {
            $title = \ucfirst($this->faker->words($this->faker->numberBetween(3, 5), true));
            $product = new Product($title);

            $product->setCategory(
                $this->getReference($this->faker->randomElement(\array_keys(CategoryFixture::CATEGORIES))))
                    ->setDescription(\ucfirst($this->faker->words($this->faker->numberBetween(4, 8), true)))
                    ->setMainImage($this->faker->imageUrl())
            ;

            //TODO: Add a reference for ImageFixture.

            if ($this->faker->boolean(80)) {
                $product->setCreatedAt(new \DateTimeImmutable());
            }

            $manager->persist($product);
        }

        $manager->flush();
    }
}
