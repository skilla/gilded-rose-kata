<?php

namespace GildedRose\Tests;
use GildedRose\Products\AgedBrie;
use GildedRose\Products\BackStage;
use GildedRose\Products\Cake;
use GildedRose\Products\Conjured;
use GildedRose\Products\Dexterity;
use GildedRose\Products\Elixir;
use GildedRose\Products\Sulfuras;
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

        $this->expectOutputString($expected);
        Program::main();
    }

    public function testDexterity()
    {
        $dexterity = new Dexterity(['sellIn' => 1, 'quality' => 20]);
        $dexterity->updateProperties();
        $this->assertEquals(19, $dexterity->quality());
        $this->assertEquals(0, $dexterity->sellIn());
        $dexterity->updateProperties();
        $this->assertEquals(17, $dexterity->quality());
        $this->assertEquals(0, $dexterity->sellIn());
    }

    public function testDexterityDecreaseTwiceWhenHasNotSellIn()
    {
        $dexterity = new Dexterity(['sellIn' => 0, 'quality' => 20]);
        $dexterity->updateProperties();
        $this->assertEquals(18, $dexterity->quality());
        $this->assertEquals(0, $dexterity->sellIn());
    }

    public function testAgedBrie()
    {
        $agedBrie = new AgedBrie(['sellIn' => 2, 'quality' => 49]);
        $agedBrie->updateProperties();
        $this->assertEquals(50, $agedBrie->quality());
        $this->assertEquals(1, $agedBrie->sellIn());
        $agedBrie->updateProperties();
        $this->assertEquals(50, $agedBrie->quality());
        $this->assertEquals(0, $agedBrie->sellIn());
    }

    public function testElixir()
    {
        $elixir = new Elixir(['sellIn' => 1, 'quality' => 20]);
        $elixir->updateProperties();
        $this->assertEquals(19, $elixir->quality());
        $this->assertEquals(0, $elixir->sellIn());
        $elixir->updateProperties();
        $this->assertEquals(17, $elixir->quality());
        $this->assertEquals(0, $elixir->sellIn());
    }

    public function testSulfuras()
    {
        $sulfuras = new Sulfuras(['sellIn' => 1, 'quality' => 20]);
        $sulfuras->updateProperties();
        $this->assertEquals(80, $sulfuras->quality());
        $this->assertEquals(0, $sulfuras->sellIn());
        $sulfuras->updateProperties();
        $this->assertEquals(80, $sulfuras->quality());
        $this->assertEquals(0, $sulfuras->sellIn());
    }

    public function testCake()
    {
        $cake = new Cake(['sellIn' => 1, 'quality' => 20]);
        $cake->updateProperties();
        $this->assertEquals(19, $cake->quality());
        $this->assertEquals(0, $cake->sellIn());
        $cake->updateProperties();
        $this->assertEquals(17, $cake->quality());
        $this->assertEquals(0, $cake->sellIn());
    }

    public function testConjured()
    {
        $cake = new Conjured(['sellIn' => 1, 'quality' => 20]);
        $cake->updateProperties();
        $this->assertEquals(18, $cake->quality());
        $this->assertEquals(0, $cake->sellIn());
        $cake->updateProperties();
        $this->assertEquals(16, $cake->quality());
        $this->assertEquals(0, $cake->sellIn());
    }

    public function testBackStage()
    {
        $backStage = new BackStage(['sellIn' => 0, 'quality' => 20]);
        $backStage->updateProperties();
        $this->assertEquals(0, $backStage->quality());
        $this->assertEquals(0, $backStage->sellIn());

        $backStage = new BackStage(['sellIn' => 11, 'quality' => 20]);
        $backStage->updateProperties();
        $this->assertEquals(21, $backStage->quality());
        $this->assertEquals(10, $backStage->sellIn());
        $backStage->updateProperties();
        $this->assertEquals(23, $backStage->quality());
        $this->assertEquals(9, $backStage->sellIn());

        $backStage = new BackStage(['sellIn' => 6, 'quality' => 20]);
        $backStage->updateProperties();
        $this->assertEquals(22, $backStage->quality());
        $this->assertEquals(5, $backStage->sellIn());
        $backStage->updateProperties();
        $this->assertEquals(25, $backStage->quality());
        $this->assertEquals(4, $backStage->sellIn());
    }
}
