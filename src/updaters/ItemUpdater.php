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
     * @param $item
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    public function update()
    {
        $this->updateQuality();
        $this->downSellIn();

        if ($this->item->sellIn < Item::SELL_IN_MIN) {
            $this->updateExpired();
        }

        return $this->item;
    }

    public function updateQuality()
    {
        $this->downQuality();

        return $this->item;
    }

    public function updateExpired()
    {
        $this->downQuality();

        return $this->item;
    }

    protected function upQuality()
    {
        if ($this->item->quality < Item::QUALITY_MAX) {
            ++$this->item->quality;
        }

        return $this->item;
    }

    protected function downQuality()
    {
        if ($this->item->quality > Item::QUALITY_MIN) {
            --$this->item->quality;
        }

        return $this->item;
    }

    protected function downSellIn()
    {
        --$this->item->sellIn;

        return $this->item;
    }
}
