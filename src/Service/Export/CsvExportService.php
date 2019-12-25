<?php

declare(strict_types=1);

namespace App\Service\Export;

use App\Exception\ExportDataIsEmptyException;
use App\Repository\Product\ProductRepositoryInterface;

class CsvExportService implements ExportServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var string
     */
    private $baseUrl;

    public function __construct(string $baseUrl, ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->baseUrl = $baseUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        if (false === $data['isPublished']) {
            $products = $this->productRepository->getProducts();
        } else {
            $products = $this->productRepository->getPublished();
        }

        if (!$products) {
            throw new ExportDataIsEmptyException();
        }

        $delimiter = ';';
        $file = fopen('php://memory', 'w');
        $fields = ['id', 'title', 'description', 'price', 'category', 'mainImage', 'createdAt'];

        fputcsv($file, $fields, $delimiter);

        foreach ($products as $product) {
            $lineData = [
                $product->getId(),
                $product->getTitle(),
                $product->getDescription(),
                $product->getPrice(),
                $product->getCategory()->getTitle(),
                $this->baseUrl.'/'.$product->getMainImage(),
                $product->getCreatedAt()->format('Y-m-d h:i:s'),
            ];
            fputcsv($file, $lineData, $delimiter);
        }

        fseek($file, 0);

        return $file;
    }
}
