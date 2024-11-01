<?php namespace App\Http\Controllers;

use App;
use App\Models\MenuWebSite;
use App\Models\Service;
use App\Models\Feature;
use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


//use App\Models\RoleModel;

class MainController extends Controller
{




    public function index()
    {

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        $lang=2;

//dd(LaravelLocalization::getCurrentLocale());
        if ( LaravelLocalization::getCurrentLocale()  == 'en')
            $lang = 1;
      if ( LaravelLocalization::getCurrentLocale()  == 'ar')
            $lang = 2;
        if ( LaravelLocalization::getCurrentLocale()  == 'he')
            $lang = 3;


        self::$data['lang'] =$lang;
        self::$data['locale'] = \App::getLocale();
        self::$data['page-not-found-view'] = 'site.404';
        self::$data['cp_route_name'] =config('app.cp_route_name');
        self::$data['menu'] = MenuWebSite::all();
        parent::$data['services']=Service::all();
        parent::$data['featurs']=Feature::all();
        parent::$data['sliders']=App\Models\Slider::all();
        parent::$data['reviews']=Review::all();
        return view('website.index',parent::$data);
    }
    public function leadForm1(Request $request)
    {
        $message = "";
        $page = "";
        //return $this->recapthaCheck($request->input('g-recaptcha-response'));
       /* if($this->recapthaCheck($request->input('g-recaptcha-response'))==1) {*/
            try {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'mobile' => 'required',
                    'subject' => 'required',
                    'message' => 'required',

                ], [
                    'name.required' => 'customer name is required.',
                    'mobile.required' => 'customer mobile is required',
                    'email.required' => 'customer email is required.',
                    'message.required' => 'customer message is required',


                ]);
                $lead = App\Models\Lead::create($request->all());

                $data = ["lead" => $lead

                ];
               /* Mail::send('website.welcome', $data, function ($message) {

                    $message->from('website@insurey.co');
                    $message->to('mkurdi@developon.co');

                    $message->subject('Lead request');
                });
                Mail::send('website.notification', $data, function ($message) use ($email) {
                    $message->from('website@insurey.co');
                    $message->to('mkurdi@developon.co');
                    $message->subject('Received Notification');
                });*/


                $message = "Thanks; We will call you soon Within 48 Hours";

            } catch (\Exception $e) {
                $message = $e->getMessage();
                return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
            }
       /* }
        else{
            return \Response::json(array('status' => '0', 'msg' => "e:" . 'Please check google recaptcha', 'close' => false, 'modal' => 'modal-treat'));
        }*/

        $message = Lang::get("Thanks for register");
        return \Response::json(array('status' => '1', 'msg' => "s:" . $message, 'close' => true));

    }


    public function leadForm2(Request $request)
    {
        $message = "";
        $page = "";
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'product_type' => 'required',
                'whatsapp' => 'nullable',
                'facebook_link' => 'nullable|url',
                'instagram_link' => 'nullable|url',
                'product_image' => 'required|image',
                'brand' => 'required',
                'terms' => 'accepted',
            ], [
                'name.required' => 'Customer name is required.',
                'email.required' => 'Customer email is required.',
                'phone.required' => 'Customer mobile is required.',
                'product_type.required' => 'Product type is required.',
                'product_image.required' => 'Product image is required.',
                'product_image.image' => 'Product image must be an image file.',
                'brand.required' => 'Trade mark is required.',
                'terms.accepted' => 'You must accept the terms and conditions.',
            ]);

            $imagePath = $request->file('product_image')->store('images');
            $hashName = $request->file('product_image')->hashName();

            $lead = new App\Models\Lead($request->except('product_image', 'terms'));

            $lead->product_image = $hashName;
            $lead->terms = $request->has('terms') ? 1 : 0;
            $lead->save();

            $data = ["lead" => $lead];

            /*Mail::send('website.welcome', $data, function ($message) {
                $message->from('website@insurey.co');
                $message->to('mkurdi@developon.co');
                $message->subject('Lead request');
            });
            Mail::send('website.notification', $data, function ($message) use ($email) {
                $message->from('website@insurey.co');
                $message->to('mkurdi@developon.co');
                $message->subject('Received Notification');
            });*/

            $message = "Thanks; We will call you soon Within 48 Hours";
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return \Response::json(['status' => '0', 'msg' => "e:" . $message, 'close' => false]);
        }

        $message = Lang::get("Thanks for register");
        return \Response::json(['status' => '1', 'msg' => "s:" . $message, 'close' => true]);
    }


}
