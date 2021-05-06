<?php

namespace Runroom\GildedRose;

class GildedRose
{
    /*
     * @var array
     */
    private array $items;

    /**
     * GildedRose constructor.
     *
     * @param $items
     */
    public function __construct($items)
    {
        $this->setItems($items);
    }

    /**
     * @param array $items
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->updateItem($item);
        }
    }

    public function updateItem($item)
    {
        $organizer = new ItemOrganizer();
        $itemOrganized = $organizer->categorize($item);

        return $itemOrganized->update();
    }

    public function updateQualityOld()
    {
        foreach ($this->items as $item) {
            if ($item->name != Item::NAME_AGED and $item->name != Item::NAME_BACKSTAGE) {
                if ($item->quality > Item::QUALITY_MIN) {
                    if ($item->name != Item::NAME_SULFURAS) {
                        $item->quality -= 1;
                    }
                }
            } elseif ($item->quality < Item::QUALITY_MAX) {
                $item->quality = $item->quality + 1;
                if ($item->name == Item::NAME_BACKSTAGE) {
                    if ($item->sellIn < Item::SELL_IN_MAX) {
                        if ($item->quality < Item::QUALITY_MAX) {
                            $item->quality = $item->quality + 1;
                        }
                    }
                    if ($item->sellIn < Item::SELL_IN_MED) {
                        if ($item->quality < Item::QUALITY_MAX) {
                            $item->quality += 1;
                        }
                    }
                }
            }

            if ($item->name != Item::NAME_SULFURAS) {
                $item->sellIn -= 1;
            }

            if ($item->sellIn < Item::SELL_IN_MIN) {
                if ($item->name != Item::NAME_AGED) {
                    if ($item->name != Item::NAME_BACKSTAGE) {
                        if ($item->quality > Item::QUALITY_MIN) {
                            if ($item->name != Item::NAME_SULFURAS) {
                                $item->quality -= 1;
                            }
                        }
                    } else {
                        $item->quality -= $item->quality;
                    }
                } elseif ($item->quality < Item::QUALITY_MAX) {
                    ++$item->quality;
                }
            }
        }
    }
}
