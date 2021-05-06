<?php

namespace Runroom\GildedRose\Tests;

use PHPUnit\Framework\TestCase;
use Runroom\GildedRose\{factories\GildedRoseFactory, factories\ItemFactory, Item};

class GildedRoseTest extends TestCase
{
    /**
     * @test
     */
    public function itemsDegradeQuality()
    {
        $items = [ItemFactory::create('', 1, 5)];

        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQuality();

        $this->assertEquals(4, $items[0]->quality);
    }

    /**
     * @test
     */
    public function itemsDegradeDoubleQualityOnceTheSellInDateHasPass()
    {
        $items = [ItemFactory::create('', -1, 5)];

        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQualityOld();

        $this->assertEquals(3, $items[0]->quality);
    }

    /**
     * @test
     */
    public function itemsCannotHaveNegativeQuality()
    {
        $items = [ItemFactory::create('', 0, 0)];

        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQualityOld();

        $this->assertEquals(0, $items[0]->quality);
    }

    /**
     * @test
     */
    public function agedBrieIncreasesQualityOverTime()
    {
        $items = [ItemFactory::create(Item::NAME_AGED, 0, 5)];

        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQualityOld();

        $this->assertEquals(7, $items[0]->quality);
    }

    /**
     * @test
     */
    public function qualityCannotBeGreaterThan50()
    {
        $items = [ItemFactory::create(Item::NAME_AGED, 0, 50)];

        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQualityOld();

        $this->assertEquals(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function sulfurasDoesNotChange()
    {
        $items = [ItemFactory::create(Item::NAME_SULFURAS, 10, 10)];

        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQualityOld();

        $this->assertEquals(10, $items[0]->sellIn);
        $this->assertEquals(10, $items[0]->quality);
    }

    public static function backstageRules()
    {
        return [
            'incr. 1 if sellIn > 10' => [11, 10, 11],
            'incr. 2 if 5 < sellIn <= 10 (max)' => [10, 10, 12],
            'incr. 2 if 5 < sellIn <= 10 (min)' => [6, 10, 12],
            'incr. 3 if 0 < sellIn <= 5 (max)' => [5, 10, 13],
            'incr. 3 if 0 < sellIn <= 5 (min)' => [1, 10, 13],
            'puts to 0 if sellIn <= 0 (max)' => [0, 10, 0],
            'puts to 0 if sellIn <= 0 (...)' => [-1, 10, 0],
        ];
    }

    /**
     * @dataProvider backstageRules
     * @test
     */
    public function backstageQualityIncreaseOverTimeWithCertainRules($sellIn, $quality, $expected)
    {
        $items = [ItemFactory::create(Item::NAME_BACKSTAGE, $sellIn, $quality)];

        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQualityOld();

        $this->assertEquals($expected, $items[0]->quality);
    }
}
