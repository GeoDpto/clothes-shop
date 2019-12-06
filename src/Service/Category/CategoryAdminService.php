<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Entity\Category;
use App\Repository\Category\CategoryRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class CategoryAdminService implements CategoryAdminServiceInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(CategoryRepositoryInterface $categoryRepository, EntityManagerInterface $em)
    {
        $this->categoryRepository = $categoryRepository;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function updateCategory(string $slug, array $data): void
    {
        $category = $this->categoryRepository->getBySlug($slug);

        if (!empty($data['title'])) {
            $category->setTitle($data['title']);
        }

        if (!empty($data['description'])) {
            $category->setDescription($data['description']);
        }

        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteCategory(int $id): void
    {
        $this->categoryRepository->deleteCategory($this->categoryRepository->getById($id));
    }

    /**
     * {@inheritdoc}
     */
    public function createCategory(array $data): void
    {
        $category = new Category($data['title']);

        if (!empty($data['description'])) {
            $category->setDescription($data['description']);
        }

        $this->categoryRepository->createCategory($category);
    }
}
