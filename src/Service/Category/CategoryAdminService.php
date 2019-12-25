<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Collection\ProductCollection;
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
    public function update(int $id, array $data): void
    {
        $category = $this->getById($id);

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
    public function delete(int $id): void
    {
        $this->categoryRepository->delete($this->categoryRepository->getById($id));
    }

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    public function save(array $data): void
    {
        $category = new Category($data['title']);

        if (!empty($data['description'])) {
            $category->setDescription($data['description']);
        }

        $this->categoryRepository->save($category);
    }

    /**
     * @param int $id
     * @return ProductCollection
     */
    public function getProductsById(int $id): ProductCollection
    {
        return new ProductCollection(...$this->categoryRepository->getProductsById($id));
    }

    public function getById(int $id): Category
    {
        return $this->categoryRepository->getById($id);
    }
}
