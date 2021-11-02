<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Validation Rules
    public function validations($rules = []) {
        return $rules += [
            'title'  => 'required|unique:categories,title',
            'status'  => 'required|in:active,inactive',
        ];
    }

    // Pass status when want list according to status type
    public function getCategoriesList( $status = null ) {
        return Category::
        when($status, function($query) use ($status) {
            $query->where('status', '=', $status);
        })
        ->orderBy('id', 'DESC')
        ->get();
    }

    // Get Category Detail
    public function getCategoryDetail( $id = null ) {
        return Category::
        when($id, function($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }


    // Store Category
    public function storeCategory( $data )
    {
        $category = new Category;

        $category->title       = $data['title'];
        $category->status      = $data['status'];

        $category->save();

        return with($category);
    }

    // Update Category
    public function updateCategory( $data )
    {
        $category = new Category;

        $category = $this->getCategoryDetail( $data['category_id'] );

        $category->title = $data['title'];
        $category->status = $data['status'];

        $category->update();

        return with($category);
    }


    // Foreign Key Relationships
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class,'category_id')->orderBy('id','Desc');
    }
}
