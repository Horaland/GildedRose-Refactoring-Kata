#!/usr/local/bin/php
<?php

require_once 'gilded_rose.php';

echo "OMGHAI!\n";

$items = array(
    new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
    );

$app = new GildedRose($items);

$days = 10;
if ((isset($argv)) && (count($argv) > 1)) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo("-------- day $i --------\n");
    echo("name, sellIn, quality\n");
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->update_quality();
}
