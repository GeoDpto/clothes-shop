<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Collection\CategoryCollection;
use App\Collection\ProductCollection;
use App\Entity\Category;
use App\Repository\Category\CategoryRepository;

class CategoryService implements CategoryServiceInterface
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    private function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getPostsBySlug(string $slug): ProductCollection
    {
        return new ProductCollection(...$this->categoryRepository->getPostsBySlug($slug));
    }

    /**
     * {@inheritdoc}.
     */
    public function getBySlug(string $slug): Category
    {
        return $this->categoryRepository->getBySlug($slug);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategories(): CategoryCollection
    {
        return new CategoryCollection(...$this->categoryRepository->getCategories());
    }
}
