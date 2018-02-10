<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 10/2/18
 * Time: 13:32
 */

namespace GildedRose\Repositories;

use GildedRose\Products\AgedBrie;
use GildedRose\Products\BackStage;
use GildedRose\Products\Cake;
use GildedRose\Products\Dexterity;
use GildedRose\Products\Elixir;
use GildedRose\Products\ProductInterface;
use GildedRose\Products\ProductRepositoryInterface;
use GildedRose\Products\Sulfuras;

class ProductRepository implements ProductRepositoryInterface
{
    private $products = [];

    public function __construct()
    {
        $this->products = [
            new Dexterity(array('name' => ProductInterface::DEXTERITY, 'sellIn' => 10, 'quality' => 20)),
            new AgedBrie(array('name' => ProductInterface::AGED_BRIE, 'sellIn' => 2, 'quality' => 0)),
            new Elixir(array('name' => ProductInterface::ELIXIR, 'sellIn' => 5, 'quality' => 7)),
            new Sulfuras(array('name' => ProductInterface::SULFURAS, 'sellIn' => 0, 'quality' => 80)),
            new BackStage(array('name' => ProductInterface::BACKSTAGE, 'sellIn' => 15, 'quality' => 20)),
            new Cake(array('name' => ProductInterface::CAKE, 'sellIn' => 3, 'quality' => 6)),
        ];
    }

    /**
     * @return ProductInterface[]
     */
    public function all(): array
    {
        return $this->products;
    }
}
