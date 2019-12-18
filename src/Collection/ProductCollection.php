<?php

declare(strict_types=1);

namespace App\Collection;

use App\Entity\Product;
use App\Exception\CollectionIsEmptyException;


class ProductCollection implements \IteratorAggregate
{
    /**
     * @var Product[]
     */
    private $products;

    /**
     * ProductCollection constructor.
     *
     * @param Product ...$products
     */
    public function __construct(Product ...$products)
    {
        $this->products = $products;
    }

    /**
     * @return Product
     * @throws CollectionIsEmptyException
     */
    public function shift(): Product
    {
        $article = \array_shift($this->products);

        if (null === $article) {
            throw new CollectionIsEmptyException('products');
        }

        return $article;
    }

    /**
     * Returns products iterator.
     */
    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->products);
    }

    /**
     * @param int $number
     * @return iterable
     */
    public function slice(int $number): ?iterable
    {
        for ($i = 0; $i < $number; ++$i) {
            try {
                yield $this->shift();
            } catch (CollectionIsEmptyException $exception) {
                return null;
            }

        }
    }
}
