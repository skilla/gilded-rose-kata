<?php

namespace GildedRose\Tests;
use GildedRose\Objects\Dexterity;
use GildedRose\Objects\ItemInterface;
use GildedRose\Program;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testOutputIsTheExpected()
    {
        $expected = 'HELLO
                                              Name -  SellIn - Quality
                                 +5 Dexterity Vest -       9 -      19
                                         Aged Brie -       1 -       1
                            Elixir of the Mongoose -       4 -       6
                        Sulfuras, Hand of Ragnaros -       0 -      80
         Backstage passes to a TAFKAL80ETC concert -      14 -      21
                                Conjured Mana Cake -       2 -       5
';

        ob_start();

        Program::Main();
        $actual = ob_get_clean();

        $this->assertEquals($expected, $actual);
    }

    public function testDexterity()
    {
        $dexterity = new Dexterity(['name' => ItemInterface::DEXTERITY, 'sellIn' => 10, 'quality' => 20]);
        $dexterity->updateQuality();
        $this->assertEquals(19, $dexterity->quality);
        $this->assertEquals(9, $dexterity->sellIn);
        $dexterity->updateQuality();
        $this->assertEquals(18, $dexterity->quality);
        $this->assertEquals(8, $dexterity->sellIn);
    }

    public function testDexterityDecreaseTwiceWhenHasNotSellIn()
    {
        $dexterity = new Dexterity(['name' => ItemInterface::DEXTERITY, 'sellIn' => 0, 'quality' => 20]);
        $dexterity->updateQuality();
        $this->assertEquals(18, $dexterity->quality);
        $this->assertEquals(-1, $dexterity->sellIn);
    }
}
