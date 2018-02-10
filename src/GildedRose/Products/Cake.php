<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 10/1/18
 * Time: 19:38
 */

namespace GildedRose\Products;

use GildedRose\Item;

class Cake extends ProductAbstract
{
    public function __construct(array $parts)
    {
        $parts['name'] = self::CAKE;
        $this->item = new Item($parts);
    }

    public function updateProperties()
    {
        $this->decreaseQualityWhenNotHasMinimumQuality();

        if ($this->isSellInHasPassed()) {
            $this->decreaseQualityWhenNotHasMinimumQuality();
        }
        $this->decreaseSellin();
    }
}
