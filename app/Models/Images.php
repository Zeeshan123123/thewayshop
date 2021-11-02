<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Images extends Model
{
    use HasFactory;


    public function storeProductImages($related_model,$item,$data)
    {
        // dd('com');
        return DB::transaction(function() use ($related_model, $item, $data){
            
            Images::where('parent_id',$item->id)->where('related_model',$related_model)->delete();

            foreach ($data as $value) {
                Images::insert([
                    'parent_id' => $item->id,
                    'related_model' => $related_model,
                    'image' => $value['image'],
                ]);
            }
            
        }); 
    }
}
