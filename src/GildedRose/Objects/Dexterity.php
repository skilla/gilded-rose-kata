<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 10/1/18
 * Time: 19:38
 */

namespace GildedRose\Objects;

use GildedRose\Item;
use GildedRose\Program;

class Dexterity extends Item implements ItemInterface
{
    public function updateQuality()
    {
        $this->decreaseQualityWhenNotHasMinimumQuality();
        $this->decreaseSellin();

        if ($this->isSellInHasPassed()) {
            $this->decreaseQualityWhenNotHasMinimumQuality();
        }
    }

    protected function decreaseQualityWhenNotHasMinimumQuality(): void
    {
        if ($this->hasQuality()) {
            $this->decreaseQuality();
        }
    }

    /**
     * @return bool
     */
    protected function hasQuality(): bool
    {
        return $this->quality > ItemInterface::MINIMUM_QUALITY;
    }

    /**
     * @return int
     */
    protected function decreaseQuality(): void
    {
        $this->quality = $this->quality - ItemInterface::QUALITY_STEP;
    }

    protected function decreaseSellin(): void
    {
        $this->sellIn = $this->sellIn - ItemInterface::SELLIN_STEP;
    }

    /**
     * @return bool
     */
    protected function isSellInHasPassed(): bool
    {
        return $this->sellIn < ItemInterface::MINIMUM_SELLIN;
    }
}
