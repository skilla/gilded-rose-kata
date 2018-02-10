<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 10/1/18
 * Time: 19:38
 */

namespace GildedRose\Products;

use GildedRose\Item;

class AgedBrie extends ProductAbstract
{
    public function __construct(array $parts)
    {
        $parts['name'] = self::AGED_BRIE;
        $this->item = new Item($parts);
    }

    public function updateProperties()
    {
        $this->increaseQualityWhenNotHasMaximumQuality();
        $this->decreaseSellin();
    }
}
