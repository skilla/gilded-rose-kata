<?php

namespace GildedRose\Tests;
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
}
