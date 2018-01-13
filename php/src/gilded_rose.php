<?php

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {
        foreach ($this->items as $item) {
            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sell_in = $item->sell_in - 1;
            }
            
            
            if ($item->name == 'Sulfuras, Hand of Ragnaros') {
                $item->quality = 80;
            }
            if (($item->name != 'Aged Brie') and ( stripos($item->name, 'Backstage passes') === FALSE )) {
                if ($item->quality > 0) {
                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        if (stripos($item->name, 'Conjured') !== FALSE ) {
                            $item->quality = $item->quality - 2;
                        } else {
                            $item->quality = $item->quality - 1;
                        }
                    } 
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if (stripos($item->name, 'Backstage passes') !== FALSE ) {
                        if ($item->sell_in < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }
            
            
            if ($item->sell_in < 0) {
                if ($item->name != 'Aged Brie') {
                    if (stripos($item->name, 'Backstage passes') !== FALSE ) {
                        $item->quality = 0;
                    } else {
                        if ($item->quality > 0) {
                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                                if (stripos($item->name, 'Conjured') !== FALSE ) {
                                    $item->quality = $item->quality - 2;
                                } else {
                                    $item->quality = $item->quality - 1;
                                }
                            }
                        }
                    } 
                        
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}

class Item {

    public $name;
    public $sell_in;
    public $quality;

    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}

