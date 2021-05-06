<?php

namespace Runroom\GildedRose;

class ItemUpdater
{
    protected $item;

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
        // update...

        return $this->item;
    }
}
