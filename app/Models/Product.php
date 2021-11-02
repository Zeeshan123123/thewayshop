<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, LogsActivity, Notifiable;

    /* Start: Logging */
        protected static $logName = 'product';

        protected static $logAttributes = ['user_id','category_id','title', 'slug', 'sku', 'short_description','long_description','meta_title','meta_description','meta_keywords', 'price', 'status'];

        //only the `created` and `updated` events will get logged automatically
        protected static $recordEvents = ['created','updated'];

        // protected static $ignoreChangedAttributes = ['password','updated_at'];

        // To log changes only
        protected static $logOnlyDirty = true;

        public function getDescriptionForEvent(string $eventName): string
        {
            return "Product {$eventName}";
        }
    /* End: Logging */


    // Validation Rules
    public function validations($rules = []) {
        return $rules += [
            'category'  => 'required',
            'title'  => 'required|string|max:300',
            'slug'  => 'required|unique:products,slug',
            'code'  => 'required|unique:products,code',
            'short_description'  => 'required|string|max:1000',
            // 'long_description'  => 'nullable|string|max:1000',
            'meta_title'  => 'nullable|string|max:300',
            'meta_description'  => 'nullable|string|max:1000',
            'meta_keywords'  => 'nullable|string|max:300',
            // 'quantity'  => 'required|string|max:300',
            // 'weight'  => 'required|string|max:300',
            // 'unit'  => 'required',
            'price'  => 'required|string|max:300',
            'status'  => 'required|in:active,inactive',
        ];
    }


    // Pass status when want list according to status type
    public function getProductsList( $status = null ) {
        return Product::
        when($status, function($query) use ($status) {
            $query->where('status', '=', $status);
        })
        ->orderBy('id', 'DESC')
        ->get();
    }

    // Get Product Details
    public function getProductDetail( $id = null, $slug = null, $code = null ) {
        return Product::
        when($id, function($query) use ($id) {
            $query->where('id', '=', $id);
        })
        ->when($slug, function($query) use ($slug) {
            $query->where('slug', '=', $slug);
        })
        ->when($code, function($query) use ($code) {
            $query->where('code', '=', $code);
        })->first();
    }

    // Get Product Single Image
    public function getProductSingleImage( $product_id )
    {
        return Images::where( 'parent_id', '=', $product_id )
        ->where( 'related_model', '=', 'Product' )
        ->first();
    }


    // Store Blog
    public function storeProduct( $data )
    {
        $product = new Product;
        $product_code = new ProductCode;

        $product->category_id = $data['category'];
        $product->title = $data['title'];
        $product->slug = $data['slug'];
        // $product->code = $data['code'];
        $product->short_description = $data['short_description'];
        // $product->long_description = $data['long_description'];
        $product->meta_title = $data['meta_title'];
        $product->meta_description = $data['meta_description'];
        $product->meta_keywords = $data['meta_keywords'];
        // $product->quantity = $data['quantity'];
        // $product->weight = $data['weight'];
        // $product->unit = $data['unit'];
        $product->price = $data['price'];
        $product->status = $data['status'];

        $product->save();

        $this->storeImages($product,$data['images']);

        foreach ($data['codes'] as $code) {
            $product_code->storeProductCodes($product->id, $code);
        }

        return with($product);
    }

    public function updateProduct( $data )
    {
        $product = new Product;

        $product = $this->getProductDetail( $data['product_id'] );

        $product->category_id = $data['category'];
        $product->title = $data['title'];
        $product->slug = $data['slug'];
        $product->code = $data['code'];
        $product->short_description = $data['short_description'];
        // $product->long_description = $data['long_description'];
        $product->meta_title = $data['meta_title'];
        $product->meta_description = $data['meta_description'];
        $product->meta_keywords = $data['meta_keywords'];
        // $product->quantity = $data['quantity'];
        // $product->weight = $data['weight'];
        // $product->unit = $data['unit'];
        $product->price = $data['price'];
        $product->status = $data['status'];

        $product->update();

        $this->storeImages($product,$data['images']);

        return with($product);
    }


    public function storeImages($product,$images)
    {
        if(isset($images) && is_array($images))
        {

            $images_list = [];

            foreach($images as $image)
            {
                $images_list[] = [

                    'product_id' => $product->id,
                    'image'      => uploadImage($image),
                ];
            }

            if(@count($images_list) > 0)
            {
                $product_image = new Images;
                $product_image->storeProductImages($related_model='Product',$product,$images_list);
            }
        }
    }



    // Foreign Key Relationships
    public function images()
    {
        return $this->hasMany(Images::class,'parent_id')->where( function($query) {
            $query->where('related_model', '=', 'Product');
        })
        ->orderBy('id','Desc');
    }
}
