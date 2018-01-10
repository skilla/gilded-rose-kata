<?php

namespace GildedRose;

/**
 * Hi and welcome to team Gilded Rose.
 *
 * As you know, we are a small inn with a prime location in a prominent city
 * ran by a friendly innkeeper named Allison. We also buy and sell only the
 * finest goods. Unfortunately, our goods are constantly degrading in quality
 * as they approach their sell by date. We have a system in place that updates
 * our inventory for us. It was developed by a no-nonsense type named Leeroy,
 * who has moved on to new adventures. Your task is to add the new feature to
 * our system so that we can begin selling a new category of items. First an
 * introduction to our system:
 *
 * - All items have a SellIn value which denotes the number of days we have to sell the item
 * - All items have a Quality value which denotes how valuable the item is
 * - At the end of each day our system lowers both values for every item
 *
 * Pretty simple, right? Well this is where it gets interesting:
 *
 * - Once the sell by date has passed, Quality degrades twice as fast
 * - The Quality of an item is never negative
 * - "Aged Brie" actually increases in Quality the older it gets
 * - The Quality of an item is never more than 50
 * - "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
 * - "Backstage passes", like aged brie, increases in Quality as it's SellIn
 *   value approaches; Quality increases by 2 when there are 10 days or less and
 *   by 3 when there are 5 days or less but Quality drops to 0 after the concert
 *
 * We have recently signed a supplier of conjured items. This requires an
 * update to our system:
 *
 * - "Conjured" items degrade in Quality twice as fast as normal items
 *
 * Feel free to make any changes to the UpdateQuality method and add any new
 * code as long as everything still works correctly. However, do not alter the
 * Item class or Items property as those belong to the goblin in the corner who
 * will insta-rage and one-shot you as he doesn't believe in shared code
 * ownership (you can make the UpdateQuality method and Items property static
 * if you like, we'll cover for you).
 *
 * Just for clarification, an item can never have its Quality increase above
 * 50, however "Sulfuras" is a legendary item and as such its Quality is 80 and
 * it never alters.
 */
class Program
{
    private $items = array();

    const AGED_BRIE = "Aged Brie";

    const BACKSTAGE = "Backstage passes to a TAFKAL80ETC concert";

    const SULFURAS = "Sulfuras, Hand of Ragnaros";

    const DEXTERITY = "+5 Dexterity Vest";

    const ELIXIR = "Elixir of the Mongoose";

    const CAKE = "Conjured Mana Cake";

    const QUALITY_STEP = 1;

    const MINIMUM_QUALITY = 0;

    const MAXIMUM_QUALITY = 50;

    const BACKSTAGE_MINIMUM_DAYS = 11;

    const BACKSTAGE_DOUBLE_DAYS = 6;

    const MINIMUM_SELLIN = 0;

    const SELLIN_STEP = 1;

    public static function Main()
    {
        echo "HELLO\n";

        $app = new Program(array(
              new Item(array( 'name' => self::DEXTERITY,'sellIn' => 10,'quality' => 20)),
              new Item(array( 'name' => self::AGED_BRIE,'sellIn' => 2,'quality' => 0)),
              new Item(array( 'name' => self::ELIXIR,'sellIn' => 5,'quality' => 7)),
              new Item(array( 'name' => self::SULFURAS,'sellIn' => 0,'quality' => 80)),
              new Item(array(
                     'name' => self::BACKSTAGE,
                     'sellIn' => 15,
                     'quality' => 20
              )),
              new Item(array('name' => self::CAKE,'sellIn' => 3,'quality' => 6)),
        ));

        $app->UpdateQuality();

        echo sprintf("%50s - %7s - %7s\n", "Name", "SellIn", "Quality");
        foreach ($app->items as $item) {
            echo sprintf("%50s - %7d - %7d\n", $item->name, $item->sellIn, $item->quality);
        }
    }

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getQuality($index)
    {
        return $this->items[$index]->quality;
    }

    public function getSellin($index)
    {
        return $this->items[$index]->sellin;
    }

    public function getName($index)
    {
        return $this->items[$index]->name;
    }

    public function UpdateQuality()
    {
        $numberOfItems = count($this->items);

        for ($i = 0; $i < $numberOfItems; $i++) {
            if (!$this->isAgedBrie($i) && !$this->isBackstage($i)) {
                if (!$this->isSulfuras($i)) {
                    $this->decreaseQualityWhenNotHasMinimumQuality($i);
                }
            } else {
                if (!$this->hasMaximumQuality($i)) {
                    $this->increaseQualityWhenNotHasMaximumQuality($i);

                    if ($this->isBackstage($i)) {
                        if ($this->isMinimumDays($i)) {
                            $this->increaseQualityWhenNotHasMaximumQuality($i);
                        }

                        if ($this->isDoubleDays($i)) {
                            $this->increaseQualityWhenNotHasMaximumQuality($i);
                        }
                    }
                }
            }

            if (!$this->isSulfuras($i)) {
                $this->decreaseSellin($i);
            }

            if (!$this->hasMinimumSellin($i)) {
                if (!$this->isAgedBrie($i)) {
                    if (!$this->isBackstage($i)) {
                        if (!$this->isSulfuras($i)) {
                            $this->decreaseQualityWhenNotHasMinimumQuality($i);
                        }
                    } else {
                        $this->setMinimumQuality($i);
                    }
                } else {
                    $this->increaseQualityWhenNotHasMaximumQuality($i);
                }
            }
        }
    }

    /**
     * @param $i
     * @return bool
     */
    protected function hasQuality($i): bool
    {
        return $this->items[$i]->quality > self::MINIMUM_QUALITY;
    }

    /**
     * @param $i
     * @return bool
     */
    protected function hasMaximumQuality($i): bool
    {
        return $this->items[$i]->quality >= self::MAXIMUM_QUALITY;
    }

    /**
     * @param $i
     * @return bool
     */
    protected function isAgedBrie($i): bool
    {
        return $this->items[$i]->name == self::AGED_BRIE;
    }

    /**
     * @param $i
     * @return bool
     */
    protected function isBackstage($i): bool
    {
        return $this->items[$i]->name == self::BACKSTAGE;
    }

    /**
     * @param $i
     * @return bool
     */
    protected function isSulfuras($i): bool
    {
        return $this->items[$i]->name == self::SULFURAS;
    }

    /**
     * @param $i
     * @return int
     */
    protected function decreaseQuality($i): void
    {
        $this->items[$i]->quality = $this->items[$i]->quality - self::QUALITY_STEP;
    }

    /**
     * @param $i
     * @return bool
     */
    protected function isMinimumDays($i): bool
    {
        return $this->items[$i]->sellIn < self::BACKSTAGE_MINIMUM_DAYS;
    }

    /**
     * @param $i
     * @return bool
     */
    protected function isDoubleDays($i): bool
    {
        return $this->items[$i]->sellIn < self::BACKSTAGE_DOUBLE_DAYS;
    }

    /**
     * @param $i
     */
    protected function decreaseSellin($i): void
    {
        $this->items[$i]->sellIn = $this->items[$i]->sellIn - self::SELLIN_STEP;
    }

    /**
     * @param $i
     */
    protected function setMinimumQuality($i): void
    {
        $this->items[$i]->quality = self::MINIMUM_QUALITY;
    }

    /**
     * @param $i
     * @return bool
     */
    protected function hasMinimumSellin($i): bool
    {
        return $this->items[$i]->sellIn >= self::MINIMUM_SELLIN;
    }

    /**
     * @param $i
     */
    protected function increaseQualityWhenNotHasMaximumQuality($i): void
    {
        if (!$this->hasMaximumQuality($i)) {
            $this->items[$i]->quality = $this->items[$i]->quality + self::QUALITY_STEP;
        }
    }

    /**
     * @param $i
     */
    protected function decreaseQualityWhenNotHasMinimumQuality($i): void
    {
        if ($this->hasQuality($i)) {
            $this->decreaseQuality($i);
        }
    }
}
