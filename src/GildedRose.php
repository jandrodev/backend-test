<?php

namespace Runroom\GildedRose;

class GildedRose
{
    /**
     * @var Item[]
     */
    private array $items;

    /**
     * GildedRose constructor.
     *
     * @param array<Item> $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->updateItem($item);
        }
    }

    /**
     * @param Item $item
     *
     * @return Item
     */
    public function updateItem(Item $item): Item
    {
        $organizer = new ItemOrganizer();
        $itemOrganized = $organizer->categorize($item);

        return $itemOrganized->update();
    }
}
