<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Setting;

class SettingController extends Controller
{

    private $product, $setting;

    public function __construct()
    {
        $this->product = new Product;
        $this->setting = new Setting;
    }

    public function index()
    {
        // Initialization
        $data = [];
        // End Initialization
        
        $data['setting'] = $this->setting->getSettings();
        $data['products'] = $this->product->getProductsList();

        return view('backend.settings.manage_settings', $data);
    }
}
