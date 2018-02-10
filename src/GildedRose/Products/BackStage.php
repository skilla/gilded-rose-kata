<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 10/1/18
 * Time: 19:38
 */

namespace GildedRose\Products;

use GildedRose\Item;

class BackStage extends ProductAbstract
{
    public function __construct(array $parts)
    {
        $parts['name'] = self::BACKSTAGE;
        $this->item = new Item($parts);
    }

    public function updateProperties()
    {
        if($this->item->sellIn==0) {
            $this->item->quality = 0;
            return;
        }
        if($this->item->sellIn<=5) {
            $this->increaseQualityWhenNotHasMaximumQuality();
            $this->increaseQualityWhenNotHasMaximumQuality();
            $this->increaseQualityWhenNotHasMaximumQuality();
            $this->decreaseSellin();
            return;
        }
        if($this->item->sellIn<=10) {
            $this->increaseQualityWhenNotHasMaximumQuality();
            $this->increaseQualityWhenNotHasMaximumQuality();
            $this->decreaseSellin();
            return;
        }
        $this->increaseQualityWhenNotHasMaximumQuality();
        $this->decreaseSellin();
    }
}
