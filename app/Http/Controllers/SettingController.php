<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        return view('admin.settings.settings')->with('settings', Setting::first());
    }

    public function update()
    {
        $this->validate(request(), [
            'site_name' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required',
            'address' => 'required',

        ]);
        $setting = Setting::first();

        $setting->site_name = request()->site_name;
        $setting->address = request()->address;
        $setting->contact_email = request()->contact_email;
        $setting->contact_number = request()->contact_number;

        $setting->save();

        Session::flash('success', 'Settings updated successfully');

        return redirect()->back();
    }
}
