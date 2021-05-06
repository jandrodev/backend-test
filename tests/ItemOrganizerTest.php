<?php

namespace Runroom\GildedRose\Tests;

use PHPUnit\Framework\TestCase;
use Runroom\GildedRose\{factories\ItemFactory,
    Item,
    ItemOrganizer,
    Updaters\ItemAgedUpdater,
    Updaters\ItemBackstageUpdater,
    Updaters\ItemSulfurasUpdater,
    Updaters\ItemUpdater
};

class ItemOrganizerTest extends TestCase
{
    /*
     * @var ItemOrganizer
     */
    protected ItemOrganizer $itemOrganizer;

    public function setUp(): void
    {
        $this->itemOrganizer = new ItemOrganizer();
    }

    public function testItemSulfurasReturnYourUpdater(): void
    {
        $item = ItemFactory::create(Item::NAME_SULFURAS, 0, 0);
        $categorize = $this->itemOrganizer->categorize($item);

        $this->assertInstanceOf(ItemSulfurasUpdater::class, $categorize);
    }

    public function testItemBackstageReturnYourUpdater(): void
    {
        $item = ItemFactory::create(Item::NAME_BACKSTAGE, 0, 0);
        $categorize = $this->itemOrganizer->categorize($item);

        $this->assertInstanceOf(ItemBackstageUpdater::class, $categorize);
    }

    public function testItemAgedReturnYourUpdater(): void
    {
        $item = ItemFactory::create(Item::NAME_AGED, 0, 0);
        $categorize = $this->itemOrganizer->categorize($item);

        $this->assertInstanceOf(ItemAgedUpdater::class, $categorize);
    }

    public function testItemWithoutLegacyNameReturnYourUpdater(): void
    {
        $item = ItemFactory::create('someName', 0, 0);
        $categorize = $this->itemOrganizer->categorize($item);

        $this->assertInstanceOf(ItemUpdater::class, $categorize);
    }

    public function testItemWithoutNameReturnYourUpdater(): void
    {
        $item = ItemFactory::create('', 0, 0);
        $categorize = $this->itemOrganizer->categorize($item);

        $this->assertInstanceOf(ItemUpdater::class, $categorize);
    }
}
