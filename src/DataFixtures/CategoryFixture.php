<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixture extends AbstractFixture
{
    /**
     * @const array CATEGORIES
     */
    private const CATEGORIES = [
        'shoes' => 'Shoes',
        'shirts' => 'shirts',
        'sweatshirts' => 'Sweatshirts',
        'sweaters' => 'Sweaters',
        'dresses' => 'Dresses',
        'jeans' => 'Jeans',
        'pants' => 'Pants',
        'Leggins' => 'Leggins',
        'hoodies' => 'Hoodies',
    ];

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $slug => $title) {
            $category = new Category($title);

            $manager->persist($category);

            $this->addReference($slug, $category);
        }

        $manager->flush();
    }
}
