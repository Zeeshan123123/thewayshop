<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;


    // Validation Rules
    public function validations($rules = []) {
        return $rules += [
            'category'  => 'required',
            'title'  => 'required|unique:sub_categories,title',
            'status'  => 'required|in:active,inactive',
        ];
    }


    // Pass status when want list according to status type
    public function getSubCategoriesList( $status = null ) {
        return SubCategory::
        when($status, function($query) use ($status) {
            $query->where('status', '=', $status);
        })->get();
    }

    // Get SubCategory Detail
    public function getSubCategoryDetail( $id = null ) {
        return SubCategory::
        when($id, function($query) use ($id) {
            $query->where('id', '=', $id);
        })
        ->first();
    }

    // Get SubCategory By Category
    public function getSubCategoryByCategory( $category_id = null ) {
        return SubCategory::where('category_id', $category_id)
        ->where('status', '=', 'active')
        ->orderBy('title', 'ASC')
        ->get();
    }


    // Store Sub Category
    public function storeSubCategory( $data )
    {
        $subcategory = new SubCategory;

        $subcategory->category_id = $data['category'];
        $subcategory->title       = $data['title'];
        $subcategory->status      = $data['status'];

        $subcategory->save();

        return with($subcategory);
    }

    // Update Sub Category
    public function updateSubCategory( $data )
    {
        $subcategory = new SubCategory;

        $subcategory = $this->getSubCategoryDetail( $data['subcategory_id'] );

        $subcategory->category_id = $data['category'];
        $subcategory->title = $data['title'];
        $subcategory->status = $data['status'];

        $subcategory->update();

        return with($subcategory);
    }



    // Foreign key relashioships
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id')->withDefault();
    }
}
