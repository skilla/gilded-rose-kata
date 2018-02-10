<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 10/1/18
 * Time: 19:38
 */

namespace GildedRose\Products;

use GildedRose\Item;

class Sulfuras extends ProductAbstract
{
    public function __construct(array $parts)
    {
        $parts['name'] = self::SULFURAS;
        $parts['sellIn'] = 0;
        $parts['quality'] = 80;
        $this->item = new Item($parts);
    }

    public function updateProperties()
    {
    }
}
