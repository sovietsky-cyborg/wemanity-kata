<?php

class GildedRose {

    private $items;
    private $quality_decrease_factor;
    const MAX_QUALITY = 50;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {

        foreach ($this->items as $item) {

            if($item->sell_in <= 0) {
                $this->quality_decrease_factor = 2;
            }else {
                $this->quality_decrease_factor = 1;
            }


            if ($item->name != 'Aged Brie' && $item->name != 'Backstage passes to a TAFKAL80ETC concert' && $item->name != 'Sulfuras, Hand of Ragnaros') {
                if ($item->quality > 0) {
                    if($item->name == 'Conjured Mana Cake') {
                        $item->quality = $item->quality - 2 * $this->quality_decrease_factor ;
                    }else{
                        $item->quality = $item->quality - 1 * $this->quality_decrease_factor ;
                    }
                }
            } else {
                if ($item->quality <= self::MAX_QUALITY) {
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if($item->sell_in > 0 ){
                            if ($item->sell_in > 10) {
                                $item->quality = $item->quality + 1;
                            }
                            if ($item->sell_in <= 10 && $item->sell_in > 5) {
                                $item->quality = $item->quality + 2 < self::MAX_QUALITY ? $item->quality + 2 : self::MAX_QUALITY;
                            }
                            if ($item->sell_in <= 5) {
                                $item->quality = $item->quality + 3 < self::MAX_QUALITY ? $item->quality + 3 : self::MAX_QUALITY;
                            }
                        }else{
                            $item->quality = 0;
                        }
                    }elseif($item->name == 'Aged Brie'){
                        $item->quality = $item->quality + 1;
                    }
                }
            }
            
            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sell_in = $item->sell_in - 1;
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

