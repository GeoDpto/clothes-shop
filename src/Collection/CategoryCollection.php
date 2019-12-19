<?php

declare(strict_types=1);

namespace App\Collection;

use App\Entity\Category;
use App\Exception\CollectionIsEmptyException;

class CategoryCollection implements \IteratorAggregate
{
    /**
     * @var Category[]
     */
    private $categories;

    /**
     * ProductCollection constructor.
     *
     * @param Category ...$categories
     */
    public function __construct(Category ...$categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return Category
     *
     * @throws CollectionIsEmptyException
     */
    public function shift(): ?Category
    {
        return \array_shift($this->categories);
    }

    /**
     * Returns categories iterator.
     */
    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->categories);
    }

    /**
     * @param int $number
     * @return iterable
     */
    public function slice(int $number): ?iterable
    {
        for ($i = 0; $i < $number; ++$i) {
            yield $this->shift();
        }
    }
}
