<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Collection\CategoryCollection;
use App\Collection\ProductCollection;
use App\Entity\Category;
use App\Repository\Category\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
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