<?php

namespace App\Classes;

class Wishlist
{
    public $items = null;
    public $price = 0;
    public $totalQty = 0;

    public function __construct($oldWishlist)
    {
    	if ($oldWishlist) {
    		$this->items = $oldWishlist->items;
    		$this->totalQty = $oldWishlist->totalQty;
    		$this->price = $oldWishlist->price;
    	}
    }

    public function add($item, $id)
    {
    	$storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
    	if ($this->items) {
    		if (array_key_exists($id, $this->items)) {
    			$storedItem = $this->items[$id];
    		}
    	}
    	$storedItem['qty']++;
    	$storedItem['price'] = $item->price;
    	$this->items[$id] = $storedItem;
    	$this->totalQty++;
    }
}
