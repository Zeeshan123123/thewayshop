<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;


    // Start: Reusable Functions
        // Pass status when want list according to status type
        public function getBlogsList( $status = null ) {
            return Blog::
            when($status, function($query) use ($status) {
                $query->where('status', '=', $status);
            })->orderBy('id', 'desc')->get();
        }

        public function getBlogDetail( $id = null, $slug = null ) {
            return Blog::
            when($id, function($query) use ($id) {
                $query->where('id', '=', $id);
            })
            ->when($slug, function($query) use ($slug) {
                $query->where('slug', '=', $slug);
            })->first();
        }
    // End: Reusable Functions


    // Store Blog
    public function storeBlog( $data )
    {
        $blog = new Blog;

        $blog->title = $data['title'];
        $blog->slug = $data['slug'];
        $blog->description = $data['description'];
        $blog->meta_title = $data['meta_title'];
        $blog->meta_description = $data['meta_description'];
        $blog->meta_keywords = $data['meta_keywords'];
        $blog->status = 'active';

        $blog->save();

        return with($blog);
    }


    // Update Blog
    public function updateBlog( $data )
    {
        $blog = new Blog;

        $blog = $this->getBlogDetail( $data['blog_id'], $slug = null );

        $blog->title = $data['title'];
        $blog->slug = $data['slug'];
        $blog->description = $data['description'];
        $blog->meta_title = $data['meta_title'];
        $blog->meta_description = $data['meta_description'];
        $blog->meta_keywords = $data['meta_keywords'];
        $blog->status = $data['status'];

        $blog->update();

        return with($blog);
    }


    // Delete Blog
    public function deleteBlog( $id )
    {
        $blog = new Blog;

        $blog = $this->getBlogDetail( $id, $slug = null );

        $blog->delete();
    }

}
