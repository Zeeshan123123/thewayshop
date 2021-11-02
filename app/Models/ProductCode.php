<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCode extends Model
{
    use HasFactory;



    // store product codes
    public function storeProductCodes( $product_id, $code )
    {
        $product_code = new ProductCode;
        
        $product_code->product_id = $product_id;
        $product_code->code = $code;
        $product_code->save();

        return with($product_code);
    }

    // check out of stock
    public function checkStock( $product_id )
    {
        $product_codes = ProductCode::where([
            'product_id' => $product_id,
            'status' => 'Unsold', 
        ])->count();

        if ( $product_codes < 1 ) {
            return 'out of stock';
        }
        else {
            return 'stock exists';
        }
    }
}
