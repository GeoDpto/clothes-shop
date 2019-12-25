<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Entity\Image;
use App\Entity\Product;
use App\Repository\Product\ProductRepositoryInterface;
use App\Service\Image\ImageUploadServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProductAdminService implements ProductAdminServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var ImageUploadServiceInterface
     */
    private $imageUploadService;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ProductAdminService constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param ImageUploadServiceInterface $imageUploadService
     * @param EntityManagerInterface $em
     */
    public function __construct(ProductRepositoryInterface $productRepository,
                                ImageUploadServiceInterface $imageUploadService,
                                EntityManagerInterface $em)
    {
        $this->productRepository = $productRepository;
        $this->imageUploadService = $imageUploadService;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id): void
    {
        $this->productRepository->delete($id);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function save(array $data): void
    {
        $product = new Product($data['title']);

        if (!empty($data['description'])) {
            $product->setDescription($data['description']);
        }

        if (!empty($data['mainImage'])) {
            $product->setMainImage($this->imageUploadService->upload($data['mainImage']));
        }

        if (!empty($data['images'])) {
            foreach ($data['images'] as $uploadedImage) {
                $image = new Image();
                $imageName = $this->imageUploadService->upload($uploadedImage);

                $image->setName($imageName);
                $image->setFolder($imageName);

                $this->em->persist($image);

                $product->addImage($image);
            }
        }

        $product->setPrice($data['price']);
        $product->setCategory($data['category']);

        $this->productRepository->save($product);
    }
}
