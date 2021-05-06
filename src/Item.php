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

    /**
     * Item constructor.
     *
     * @param $name
     * @param $sellIn
     * @param $quality
     */
    public function __construct($name, $sellIn, $quality)
    {
        $this->name = $name;
        $this->sellIn = $sellIn;
        $this->quality = $quality;
    }

    public function __toString()
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}
