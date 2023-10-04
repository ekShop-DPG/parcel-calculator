<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Country;
use App\Models\countrySetting;
use App\Models\securitySettings;

class HomeController extends Controller
{
    public function index(){
        $country = Country::all();
        // $company = Company::with('countrySetting')->get();
        // $security = securitySettings::all();

        return view('index',compact('country'));
    }

    public function getData($id){
        $data['companies'] = countrySetting::join('companies','country_settings.company_id','=','companies.id')
                        ->join('countries','country_settings.country_id','=','countries.id')
                        ->where('country_id',$id)
                        ->orderby('country_settings.id','asc')
                        ->get();

        $data['security'] = securitySettings::all();

        $registerd_price=$data['security'][0]->registeredParcel_price;
        $ekshop_parcel=$data['security'][0]->ekshop_parcel_charge;
        $ekshop_letter=$data['security'][0]->ekshop_letter_charge;

        // foreach ($data['security'] as $key => $item) {
        //     $registerd_price = $registerd_price+$item->registeredParcel_price;
        // }

        foreach ($data['companies'] as $key => $value) {
            if(strtolower($value->company_shortcode) =='em'){

                $value->parcel_base_price = $value->parcel_base_price + $registerd_price+$ekshop_parcel;
            }else{
                $value->parcel_base_price = $value->parcel_base_price+$ekshop_parcel;
                $value->letters_base_price = $value->letters_base_price+$ekshop_letter;
                $value->documents_base_price = $value->documents_base_price+$ekshop_letter;
                $value->goods_base_price = $value->goods_base_price+$ekshop_letter;
            }
        }
        return response($data);
    }
}
