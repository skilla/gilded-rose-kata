<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 10/1/18
 * Time: 19:57
 */

namespace GildedRose\Objects;

interface ItemInterface
{
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
}
