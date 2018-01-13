<?php
require_once 'gilded_rose.php';

class GildedRoseTest extends \PHPUnit_Framework_TestCase {

    function testNormal() {
        $items = array(
            new Item("Aardvark", 2, 4),
        );
        $gildedRose = new GildedRose($items);
        //inital value check
        $this->assertEquals(4, $items[0]->quality);
        $this->assertEquals(2, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(3, $items[0]->quality);
        $this->assertEquals(1, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(2, $items[0]->quality);
        $this->assertEquals(0, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(0, $items[0]->quality);
        $this->assertEquals(-1, $items[0]->sell_in);
    }
    
    function testAgedBrie() {
        $items = array(
            new Item("Aged Brie", 2, 10),
            new Item("Aged Brie", 2, 50)
        );
        $gildedRose = new GildedRose($items);
        //inital value check
        $this->assertEquals(10, $items[0]->quality);
        $this->assertEquals(2, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(11, $items[0]->quality);
        $this->assertEquals(1, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(12, $items[0]->quality);
        $this->assertEquals(0, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(14, $items[0]->quality);
        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(50, $items[1]->quality);
    }

    function testSulfuras() {
        $items = array(
            new Item("Sulfuras, Hand of Ragnaros", 2, 20),
        );
        $gildedRose = new GildedRose($items);
        //inital value check
        $this->assertEquals(20, $items[0]->quality);
        $this->assertEquals(2, $items[0]->sell_in);
        $gildedRose->update_quality(); //never age and always 80 quality
        $this->assertEquals(80, $items[0]->quality);
        $this->assertEquals(2, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(80, $items[0]->quality);
        $this->assertEquals(2, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(80, $items[0]->quality);
        $this->assertEquals(2, $items[0]->sell_in);
    }
    
    function testBackstage() {
        $items = array(
            new Item("Backstage passes to a TAFKAL80ETC concert", 12, 20),
        );
        $gildedRose = new GildedRose($items);
        //inital value check
        $this->assertEquals(20, $items[0]->quality);
        $this->assertEquals(12, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(21, $items[0]->quality);
        $this->assertEquals(11, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(23, $items[0]->quality);
        $this->assertEquals(10, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(25, $items[0]->quality);
        $this->assertEquals(9, $items[0]->sell_in);
        $gildedRose->update_quality();
        $gildedRose->update_quality();
        $gildedRose->update_quality();
        $gildedRose->update_quality();
        $this->assertEquals(34, $items[0]->quality);
        $this->assertEquals(5, $items[0]->sell_in);
        $gildedRose->update_quality();
        $gildedRose->update_quality();
        $gildedRose->update_quality();
        $gildedRose->update_quality();
        $gildedRose->update_quality();
        $this->assertEquals(0, $items[0]->sell_in);
        $this->assertEquals(49, $items[0]->quality);
        $gildedRose->update_quality();
        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(0, $items[0]->quality);
        
    }
    
    function testConjured() {
        $items = array(
            new Item("Conjured Elephant", 2, 8),
        );
        $gildedRose = new GildedRose($items);
        //inital value check
        $this->assertEquals(8, $items[0]->quality);
        $this->assertEquals(2, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(6, $items[0]->quality);
        $this->assertEquals(1, $items[0]->sell_in);
        $gildedRose->update_quality();
        $this->assertEquals(4, $items[0]->quality);
        $this->assertEquals(0, $items[0]->sell_in);
        $gildedRose->update_quality(); //reduce Q by 4 when out of date
        $this->assertEquals(0, $items[0]->quality);
        $this->assertEquals(-1, $items[0]->sell_in);
        $gildedRose->update_quality(); //quality won't go below 0
        $this->assertEquals(0, $items[0]->quality);
        $this->assertEquals(-2, $items[0]->sell_in);
    }
    
}
