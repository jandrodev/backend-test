<?php

namespace Runroom\GildedRose\Tests;

use PHPUnit\Framework\TestCase;
use Runroom\GildedRose\{factories\GildedRoseFactory, factories\ItemFactory, Item};

class GildedRoseTest extends TestCase
{
    public function testItemsDegradeQuality(): void
    {
        $items = ItemFactory::create('', 1, 5)->toArray();
        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQuality();

        $this->assertEquals(4, $items[0]->quality);
    }

    public function testTwoItemsDegradeQuality(): void
    {
        $item1 = ItemFactory::create('', 1, 5);
        $item2 = ItemFactory::create('', 1, 5);
        $items = [$item1, $item2];
        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQuality();

        $this->assertEquals(4, $items[0]->quality);
        $this->assertEquals(4, $items[1]->quality);
    }

    public function testItemsDegradeDoubleQualityOnceTheSellInDateHasPass(): void
    {
        $items = ItemFactory::create('', -1, 5)->toArray();
        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQuality();

        $this->assertEquals(3, $items[0]->quality);
    }

    public function testItemsCannotHaveNegativeQuality(): void
    {
        $items = ItemFactory::create('', 0, 0)->toArray();
        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQuality();

        $this->assertEquals(0, $items[0]->quality);
    }

    public function testAgedBrieIncreasesQualityOverTime(): void
    {
        $items = ItemFactory::create(Item::NAME_AGED, 0, 5)->toArray();
        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQuality();

        $this->assertEquals(7, $items[0]->quality);
    }

    public function testQualityCannotBeGreaterThan50(): void
    {
        $items = ItemFactory::create(Item::NAME_AGED, 0, 50)->toArray();
        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQuality();

        $this->assertEquals(50, $items[0]->quality);
    }

    public function testSulfurasDoesNotChange(): void
    {
        $items = ItemFactory::create(Item::NAME_SULFURAS, 10, 10)->toArray();
        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQuality();

        $this->assertEquals(10, $items[0]->sellIn);
        $this->assertEquals(10, $items[0]->quality);
    }

    /**
     * @return int[][]
     */
    public static function backstageRules(): array
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
     */
    public function testBackstageQualityIncreaseOverTimeWithCertainRules(int $sellIn, int $quality, int $expected): void
    {
        $items = ItemFactory::create(Item::NAME_BACKSTAGE, $sellIn, $quality)->toArray();
        $gildedRose = GildedRoseFactory::create($items);
        $gildedRose->updateQuality();

        $this->assertEquals($expected, $items[0]->quality);
    }
}
