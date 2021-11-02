<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

use Validator;
use Crypt;

class BlogController extends Controller
{
    public function index()
    {
        // Initialization
            $blog = new Blog;
            $data = [];
            $data['page_title'] = 'Blogs';
        // End Initialization

        $data['blogs'] = $blog->getBlogsList();

        return view('backend.blogs.manage_blogs', $data);
    }

    public function create()
    {
        // Initialization
            $data = [];
            $data['page_title'] = 'Blogs';
            $data['form_data'] =
            array(
                'form_title'       => 'blog_information',
                'title'            => 'title',
                'slug'             => 'slug',
                'description'      => 'description',
                'meta_title'       => 'meta_title',
                'meta_description' => 'meta_description',
                'meta_keywords'    => 'meta_keywords',
            );
        // End Initialization

        return view('backend.blogs.add_blog', $data);
    }

    // Check Slug In Db
    public function checkSlugInDb(Request $request)
    {
        try {
            if ( $request->ajax() ) {
                // Intialization
                    $data = $request->input();
                    $blog = new Blog;
                // End Intialization

                if ( is_null($data['slug']) ) {
                    return response()->json(['error'=>'Please enter slug.']);
                }

                $blog = $blog->getBlogDetail( null, $data['slug'] );

                if ( $blog->id == $data['blog_id'] ) {
                    return;
                }

                if (!is_null($blog)) {
                    return response()->json(['error'=>'Slug already exists.']);
                }
            }
        } catch (Exception $e) {
            return response()->json(['error'=>'Slug error.']);
        }
    }

    public function store( Request $request )
    {
        // Initialization
            $data = $request->input();
            $blog = new Blog;
        // End Initialization

        $validator = $this->validateStoreBlogRequest($request->all());

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $blog = $blog->storeBlog($data);

        if ( $blog->id ) {
            return redirect('blogs')->with('success', 'Blog Has Been Successfully Posted.');
        }
        else {
            return redirect()->back()->with('error', 'Blog Posting Error.');
        }
    }

    public function edit( $id )
    {
        // Initialization
            $id = Crypt::decrypt($id);
            $blog = new Blog;
            $data = [];
            $data['page_title'] = 'Blogs';
            $data['form_data'] =
            array(
                'form_title'       => 'edit_blog_information',
                'title'            => 'title',
                'slug'             => 'slug',
                'description'      => 'description',
                'meta_title'       => 'meta_title',
                'meta_description' => 'meta_description',
                'meta_keywords'    => 'meta_keywords',
            );
        // End Initialization

        $data['blog'] = $blog->getBlogDetail( $id, null );

        return view('backend.blogs.edit_blog', $data);
    }

    public function update( Request $request )
    {
        // Initialization
            $data = $request->input();
            $data['blog_id'] = Crypt::decrypt($data['blog_id']);
            $blog = new Blog;
        // End Initialization

        $validator = $this->validateUpdateBlogRequest($data);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $blog = $blog->updateBlog( $data );

        if ( $blog->id ) {
            return redirect('blogs')->with('success', 'Blog Has Been Successfully Updated.');
        }
        else {
            return redirect()->back()->with('error', 'Blog Updating Error.');
        }
    }


    public function delete( $id )
    {
        try
        {
            // Initialization
                $id = decrypt($id);
                $blog = new Blog;
            // End Initialization

            $blog->deleteBlog( $id );

            return redirect('blogs')->with('success', 'Blog Has Been Successfully Updated.');

        }
        catch (DecryptException $e)
        {
            return;
        }

        return redirect('bank');
    }






    /* Start: Validations */
        public function validateStoreBlogRequest(array $data)
        {
            return Validator::make($data, [
                'title'  => 'required|string|max:300',
                'slug'  => 'required|unique:blogs',
                'description'  => 'required|string|max:1000',
                'meta_title'  => 'required|string|max:300',
                'meta_description'  => 'required|string|max:1000',
                'meta_keywords'  => 'required|string|max:300',
            ]);
        }

        public function validateUpdateBlogRequest(array $data)
        {
            return Validator::make($data, [
                'title'  => 'required|string|max:300',
                'slug'  => 'required|unique:blogs,slug,'.$data['blog_id'],
                'description'  => 'required|string|max:1000',
                'meta_title'  => 'required|string|max:300',
                'meta_description'  => 'required|string|max:1000',
                'meta_keywords'  => 'required|string|max:300',
            ]);
        }
    /* End: Validations */
}
