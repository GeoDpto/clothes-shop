<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class DateExtension extends AbstractExtension
{
    /**
     * @return array|TwigFilter[]
     */
/*    public function getFilters()
    {
        return [
            new TwigFilter('date', [$this, 'formatDate']),
        ];
    }*/

    /**
     * @param \DateTimeInterface $date
     * @param string $format
     * @return string
     *//*
    public function formatDate(\DateTimeInterface $date, string $format = 'd-m-Y H:i:s'): string
    {
        return $date->format($format);
    }*/
}
