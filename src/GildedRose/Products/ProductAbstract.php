<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 10/1/18
 * Time: 19:38
 */

namespace GildedRose\Products;

use GildedRose\Item;

abstract class ProductAbstract implements ProductInterface
{
    protected $item;

    public abstract function __construct(array $parts);

    public abstract function updateProperties();

    public function name(): string
    {
        return $this->item->name;
    }

    public function quality(): int
    {
        return $this->item->quality;
    }

    public function sellIn(): int
    {
        return $this->item->sellIn;
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
        return $this->item->quality > ProductInterface::MINIMUM_QUALITY;
    }

    protected function decreaseQuality(): void
    {
        $this->item->quality = $this->item->quality - ProductInterface::QUALITY_STEP;
    }

    protected function decreaseSellin(): void
    {
        if($this->item->sellIn <= ProductInterface::MINIMUM_SELLIN) {
            return;
        }
        $this->item->sellIn = $this->item->sellIn - ProductInterface::SELLIN_STEP;
    }

    /**
     * @return bool
     */
    protected function isSellInHasPassed(): bool
    {
        return $this->item->sellIn <= ProductInterface::MINIMUM_SELLIN;
    }

    protected function increaseQualityWhenNotHasMaximumQuality(): void
    {
        if (!$this->hasMaximumQuality()) {
            $this->item->quality = $this->item->quality + ProductInterface::QUALITY_STEP;
        }
    }

    /**
     * @return bool
     */
    protected function hasMaximumQuality(): bool
    {
        return $this->item->quality >= ProductInterface::MAXIMUM_QUALITY;
    }
}
