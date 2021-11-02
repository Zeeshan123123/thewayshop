<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Blog;
use App\Models\Contact;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;

class FrontEndController extends Controller
{
    private $product;

    public function __construct()
    {
        $this->product = new Product;
    }

    public function home()
    {
        // Initialization
            $data = [];
        // End Initialization

        $data['products'] = $this->product->getProductsList();
        
        return view('frontend.home', $data);
    }

    public function termsAndConditions()
    {
        return view('frontend.terms');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function faqs()
    {
        return view('frontend.faqs');
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }

    public function blogs()
    {
        $blog = new Blog();
        $data = $blog->getBlogsList('active');
        return view('frontend.blog', ['data' => $data]);
    }

    public function sendEmail(Request $request)
    {
        if ($request->ajax()){
            // Form Validation
//            $validation = Validator::make($request->all(), [
//                'name' => ['required'],
//                'email' => ['required|email'],
//                'subject'=> ['required'],
//                'message' => ['required']
//            ]);
//            if ($validation->fails()){
//                return response()->json(['code' => 400, 'message' => $validation->errors()->first()]);
//            }
            $data = $request->get('data');
            $name = $data['name'];
            $email = $data['email'];
            $subject = $data['subject'];
            $message = $data['message'];
            //  Store data in database
            Contact::create([
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            ]);
            $msg = "
            Name : $name
            Email: $email
            Subject: $subject
            Message: $message";
            $receiver = "akmalkhancreativetechsol@gmail.com";
            Mail::to($receiver)->send(new ContactMail($msg));
            return response()->json(['code' => 200, 'msg' => 'Thanks for contacting us, we will get back to you soon.']);
        }
    }
}
