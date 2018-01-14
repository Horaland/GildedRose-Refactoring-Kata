<?php

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {
        foreach ($this->items as $item) {
            $item->update_quality();
        }
    }    
    
    /**
     * Alterign the wrong code could be life threatening. 
     * This function should kill the Goblin in the corner should he make 
     * his presence felt.
     * @global type $goblin
     */
    function kill_goblin() {
        global $goblin;
        if (isset($goblin)) {
            unset($goblin);
        }
        echo "Thwack... gurgle, gurgle, thunk.";
        $this->items[] = Item_Factory::build('Dead Goblin', 0, 0);
    } 
}

class Item_Basic extends Item {
    
    function update_quality() {
        $this->sell_in = $this->sell_in - 1;
        $this->quality = $this->quality - 1;
        if ($this->sell_in < 0) {
            $this->quality = $this->quality - 1;
        }
    }
}


class Item_Aged_Brie extends Item {
    
    /**
     * Brie improves with age, twice as fast after the sellby date
     * can't be more that 50 quality
     */
    function update_quality() {
        $this->sell_in = $this->sell_in - 1;
        $this->quality = $this->quality + 1;
        if ($this->sell_in < 0 ) {
            $this->quality = $this->quality + 1;
        }
        if ($this->quality > 50) {
            $this->quality = 50;
        }
    }
}

class Item_Backstage_Pass extends Item {
    
    function update_quality() {
        $this->sell_in = $this->sell_in - 1;
        if ($this->sell_in >= 0) {
            $this->quality = $this->quality + 1;
            if ($this->sell_in <= 10) {
                $this->quality = $this->quality + 1;
            }
            if ($this->sell_in <= 5) {
                $this->quality = $this->quality + 1;
            }
        } else {
            $this->quality = 0;
        }
        if ($this->quality > 50) {
            $this->quality = 50;
        }
    }
}

class Item_Sulfuras_Hand_Of_Ragnaros extends Item {
    
    /**
     * 
     * @param type $name
     * @param type $sell_in
     * @param type $quality
     */
    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = 80;
    }
    
    function update_quality() {
        $this->sell_in = $this->sell_in;
        $this->quality = 80;
    }
}

class Item_Conjured extends Item {
    
    function update_quality() {
        $this->sell_in = $this->sell_in - 1;
        $this->quality = $this->quality - 2;
        if ($this->sell_in < 0) {
            $this->quality = $this->quality - 2;
        }
        if ($this->quality < 0) {
            $this->quality = 0;
        }
    }
}



class Item_Factory {
    
    public static function build($name, $sell_in, $quality)
    {
        $prodname = str_replace(' ', '_', $name); //replace spaces with _ cor class construction
        $prodname = str_replace(',', '', $prodname); //remove commas for class construction
        $product = "Item_" . mb_convert_case($prodname, MB_CASE_TITLE);
        if(class_exists($product)) {
          return new $product($name, $sell_in, $quality);
        } elseif (stripos($name, 'Backstage passes') !== FALSE ) {
          return new Item_Backstage_Pass($name, $sell_in, $quality);
        } elseif (stripos($name, 'Conjured') !== FALSE ) {
          return new Item_Conjured($name, $sell_in, $quality);
        } else {    
          return new Item_Basic($name, $sell_in, $quality);
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

