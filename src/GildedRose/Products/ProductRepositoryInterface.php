<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 10/2/18
 * Time: 13:36
 */

declare(strict_types=1);

namespace GildedRose\Products;

interface ProductRepositoryInterface
{
    /**
     * @return ProductInterface[]
     */
    public function all(): array;
}
