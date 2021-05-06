<?php

namespace Runroom\GildedRose\Updaters;

use Runroom\GildedRose\Item;

class ItemUpdater
{
    /*
     * @var Item
     */
    protected Item $item;

    /**
     * ItemUpdater constructor.
     *
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @return Item
     */
    public function update(): Item
    {
        $this->updateQuality();
        $this->downSellIn();

        if ($this->item->sellIn < Item::SELL_IN_MIN) {
            $this->updateExpired();
        }

        return $this->item;
    }

    /**
     * @return Item
     */
    public function updateQuality(): Item
    {
        $this->downQuality();

        return $this->item;
    }

    /**
     * @return Item
     */
    public function updateExpired(): Item
    {
        $this->downQuality();

        return $this->item;
    }

    /**
     * @return Item
     */
    protected function upQuality(): Item
    {
        if ($this->item->quality < Item::QUALITY_MAX) {
            ++$this->item->quality;
        }

        return $this->item;
    }

    /**
     * @return Item
     */
    protected function downQuality(): Item
    {
        if ($this->item->quality > Item::QUALITY_MIN) {
            --$this->item->quality;
        }

        return $this->item;
    }

    /**
     * @return Item
     */
    protected function downSellIn(): Item
    {
        --$this->item->sellIn;

        return $this->item;
    }
}
