<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Collection\ProductCollection;
use App\Entity\Product;
use App\Repository\Product\ProductRepository;
use App\Repository\Product\ProductRepositoryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class ProductPresentationService implements ProductPresentationServiceInterface
{
    /**
     * @var ProductRepository
     */
    private $productPresentationRepository;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * ProductPresentationService constructor.
     * @param ProductRepositoryInterface $productPresentationRepository
     * @param PaginatorInterface $paginator
     */
    public function __construct(ProductRepositoryInterface $productPresentationRepository, PaginatorInterface $paginator)
    {
        $this->productPresentationRepository = $productPresentationRepository;
        $this->paginator = $paginator;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublished(): ProductCollection
    {
        return new ProductCollection(...$this->productPresentationRepository->getPublished());
    }

    public function getPaginatedProducts(int $int = 0): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->productPresentationRepository->getPublished(),
            $int,
            10
        );

    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): Product
    {
        $product = $this->productPresentationRepository->getById($id);

        return $product;
    }

    /**
     * {@inheritdoc}
     */
    public function getLatest(int $count = 16): ProductCollection
    {
        return new ProductCollection(...$this->productPresentationRepository->getLatest($count));
    }
}
