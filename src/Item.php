<?php

namespace Runroom\GildedRose;

class Item
{
    /*
     * @var string
     */
    public string $name;

    /*
     * @var int
     */
    public int $sellIn;

    /*
     * @var int
     */
    public int $quality;

    public const NAME_AGED = 'Aged Brie';
    public const NAME_BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    public const NAME_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    public const SELL_IN_MIN = 0;
    public const SELL_IN_MED = 6;
    public const SELL_IN_MAX = 11;

    public const QUALITY_MIN = 0;
    public const QUALITY_MAX = 50;

    /**
     * Item constructor.
     *
     * @param string $name
     * @param int $sellIn
     * @param int $quality
     */
    public function __construct(string $name, int $sellIn, int $quality)
    {
        $this->name = $name;
        $this->sellIn = $sellIn;
        $this->quality = $quality;
    }
}
