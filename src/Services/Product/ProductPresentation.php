<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Collection\ProductCollection;
use App\Entity\Product;
use App\Repository\Product\ProductRepository;
use App\Repository\Product\ProductRepositoryInterface;

class ProductPresentation implements ProductPresentationInterface
{
    /**
     * @var ProductRepository
     */
    private $productPresentationRepository;

    /**
     * ProductPresentation constructor.
     * @param ProductRepositoryInterface $productPresentationRepository
     */
    public function __construct(ProductRepositoryInterface $productPresentationRepository)
    {
        $this->productPresentationRepository = $productPresentationRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublished(): ProductCollection
    {
        return $this->productPresentationRepository->getPublished();
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): Product
    {
        return $this->productPresentationRepository->getById($id);
    }

    public function getLatest(): ProductCollection
    {
        return $this->productPresentationRepository->getLatest();
    }
}
