<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\countrySetting;
use App\Models\generalSetting;
use App\Models\securitySettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    // -----------------------Admin Login Operation----------------//
    public function login(){
        return view('admin.login');
    }
    public function customLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("admin")->with('error','Login details are not valid');
    }
    public function index()
    {
        if(Auth::check()){
            $allCountry = Country::count();
            $company = Company::count();
            return view('admin.index',compact('allCountry','company'));
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('admin');
    }
    
    //------------------- Company All Operation---------------------------//
    public function create(){
        $company = Company::all();
        return view('admin.company',compact('company'));
    }
    public function store_company(Request $request){
        $request->validate([
            'company_name' => 'required',
            'company_shortcode' => 'required|unique:companies|max:2',
            'parcel_weight_slot'=>'required',
            'bg_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $company = new Company();
        $company->name = $request->company_name;
        $company->company_shortcode = $request->company_shortcode;
        $company->parcel_weight_slot = $request->parcel_weight_slot;
        $company->letters_weight_slot = $request->letters_weight_slot;
        $company->documents_weight_slot = $request->documents_weight_slot;
        $company->goods_weight_slot = $request->goods_weight_slot;
        if($request->company_logo){
            $imageName = time().'.'.$request->company_logo->extension();  
            $request->company_logo->move(public_path('company_logo'), $imageName);
            $company->company_logo = $imageName;
        }
        if($request->bg_image){
            $imageName = time().'.'.$request->bg_image->extension();  
            $request->bg_image->move(public_path('bg_image'), $imageName);
            $company->bg_image = $imageName;
        }
        $company->bg_color = $request->bg_color;
        $company->save();
        return redirect()->back()->with('message','data stored successfully!!!');
    }
    public function update_company(Request $request,$id){
        $request->validate([
            'company_name' => 'required',
            'parcel_weight_slot'=>'required',
            'company_shortcode' => 'required|unique:companies|max:2',
            // 'bg_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $company = Company::where('id',$id)->first();
        $company->name = $request->company_name;
        $company->company_shortcode = $request->company_shortcode;
        $company->parcel_weight_slot = $request->parcel_weight_slot;
        $company->letters_weight_slot = $request->letters_weight_slot;
        $company->documents_weight_slot = $request->documents_weight_slot;
        $company->goods_weight_slot = $request->goods_weight_slot;
        if($request->company_logo){
            $imageName = time().'.'.$request->company_logo->extension();  
            $request->company_logo->move(public_path('company_logo'), $imageName);
            $company->company_logo = $imageName;
        }
        if($request->bg_image){
            $imageName = time().'.'.$request->bg_image->extension();  
            $request->bg_image->move(public_path('bg_image'), $imageName);
            $company->bg_image = $imageName;
        }
        // $company->bg_color = $request->bg_color;
        $company->save();
        return redirect()->back()->with('message','data Upadate successfully!!!');
    }
    public function edit_company($id){
        $company = Company::where('id',$id)->get();
        return response()->json($company);
    }
    public function delete_service($id){
        countrySetting::where('id',$id)->delete();
        return redirect()->back()->with('message','Company Delete Successfully !!');
    }
    public function delete_company($id){
        Company::where('id',$id)->delete();
        return redirect()->back()->with('message','Company Delete Successfully !!');
    }
    //------------------------------- Add Country-----------------//
    public function show_country(){
        $country = Country::all();
        return view('admin.country',compact('country'));
    }
    public function store_country(Request $request){
        $request->validate([
            'country_name'=>'required',
            'country_code'=>'required|unique:countries|max:2',
            'region'=>'required',
        ]);
        $country = new Country();
        $country->country_name = $request->country_name;
        $country->country_code = $request->country_code;
        $country->region = $request->region;
        $country->airSurcharge = $request->airSurcharge;

        $country->save();
        return redirect()->back()->with('message','Data stored Successfully');
    }
    public function edit_country($id){
        $allCountry = Country::where('id',$id)->get();
        return response()->json($allCountry);
    }
    public function updateCountry(Request $request,$id){
        $country_data = Country::where('id',$id)->first();
        $country_data->country_name = $request->country_name;
        $country_data->country_code = $request->country_code;
        $country_data->region = $request->region;
        $country_data->airSurcharge = $request->airSurcharge;

        $country_data->save();
        return redirect()->back()->with('message','Data Update Successfully');
    }



    //-----------------parcel settings--------------//
    public function country_settings(){
        $parcelservices = DB::table('country_settings')
                        ->join('companies','country_settings.company_id','=','companies.id')
                        ->join('countries','country_settings.country_id','=','countries.id')
                        ->select('country_settings.*','companies.name','companies.company_logo','companies.parcel_weight_slot','companies.letters_weight_slot','companies.documents_weight_slot','companies.goods_weight_slot','countries.country_name')
                        ->get();
        $country_data = Country::all();
        $company_data = Company::all();
        return view('admin.country_settings',compact('country_data','company_data',"parcelservices"));
    }

    public function countrySettings(Request $request){
        $request->validate([
            'country_id'=>'required',
            'company_id'=>'required',
            'parcel_base_price'=>'required',
            'parcel_hike_price'=>'required',
            'letters_base_price'=>'required',
            'letters_hike_price'=>'required',
            'documents_base_price'=>'required',
            'documents_hike_price'=>'required',
            'delivery_days'=>'required',
            'parcelPost_capacity'=>'required',
            'letterPost_capacity'=>'required',
        ]);

        $countrySettings = new countrySetting();
        $countrySettings->country_id = $request->country_id;
        $countrySettings->company_id = $request->company_id;
        if($request->is_special_price){
            $countrySettings->is_special_price = '1';
        }
        $countrySettings->parcel_base_price = $request->parcel_base_price;
        $countrySettings->parcel_hike_price = $request->parcel_hike_price;
        $countrySettings->letters_base_price = $request->letters_base_price;
        $countrySettings->letters_hike_price = $request->letters_hike_price;
        $countrySettings->documents_base_price = $request->documents_base_price;
        $countrySettings->documents_hike_price = $request->documents_hike_price;
        $countrySettings->goods_base_price = $request->goods_base_price;
        $countrySettings->goods_hike_price = $request->goods_hike_price;
        $countrySettings->delivery_days = $request->delivery_days;
        $countrySettings->parcelPost_capacity = $request->parcelPost_capacity;
        $countrySettings->letterPost_capacity = $request->letterPost_capacity;
        $countrySettings->country_parcel_weight_slot = $request->parcel_weight_slot;
        $countrySettings->country_letters_weight_slot = $request->letters_weight_slot;
        $countrySettings->country_documents_weight_slot = $request->documents_weight_slot;
        $countrySettings->country_goods_weight_slot = $request->goods_weight_slot;


        $countrySettings->save();
        return redirect()->back()->with('message','Data Stored Successfully');
    }
    public function check_company($id,$country){
        $check = countrySetting::where([['company_id','=',$id],['country_id','=',$country]])->count();
        if($check>0){
            return 1;
        }else{
            return 0;
        }
    }


    public function edit_countrySettings($id){
    $countrySettingsData = countrySetting::where('id',$id)->first();
    return response()->json($countrySettingsData);
    }

    public function save_countrySettings(Request $request,$id){
        $request->validate([
            'country_id'=>'required',
            'company_id'=>'required',
            'parcel_base_price'=>'required',
            'parcel_hike_price'=>'required',
            'letters_base_price'=>'required',
            'letters_hike_price'=>'required',
            'documents_base_price'=>'required',
            'documents_hike_price'=>'required',
            'delivery_days'=>'required',
            'parcelPost_capacity'=>'required',
            'letterPost_capacity'=>'required',
        ]);

        $countrySettings = countrySetting::where('id',$id)->first();
        $countrySettings->country_id = $request->country_id;
        $countrySettings->company_id = $request->company_id;
        if($request->is_special_price){
            $countrySettings->is_special_price = '1';
        }
        $countrySettings->parcel_base_price = $request->parcel_base_price;
        $countrySettings->parcel_hike_price = $request->parcel_hike_price;
        $countrySettings->letters_base_price = $request->letters_base_price;
        $countrySettings->letters_hike_price = $request->letters_hike_price;
        $countrySettings->documents_base_price = $request->documents_base_price;
        $countrySettings->documents_hike_price = $request->documents_hike_price;
        $countrySettings->goods_base_price = $request->goods_base_price;
        $countrySettings->goods_hike_price = $request->goods_hike_price;
        $countrySettings->delivery_days = $request->delivery_days;
        $countrySettings->parcelPost_capacity = $request->parcelPost_capacity;
        $countrySettings->letterPost_capacity = $request->letterPost_capacity;
        $countrySettings->country_parcel_weight_slot = $request->parcel_weight_slot;
        $countrySettings->country_letters_weight_slot = $request->letters_weight_slot;
        $countrySettings->country_documents_weight_slot = $request->documents_weight_slot;
        $countrySettings->country_goods_weight_slot = $request->goods_weight_slot;


        $countrySettings->save();
        return redirect()->back()->with('message','Data Stored Successfully');
    }

    //-------------------General Settings---------------//
    public function generalSettings(Request $request){
        $settings = new generalSetting();
        $settings->delivery_days = $request->delivery_days;
        $settings->parcelPost_capacity = $request->parcelPost_capacity;
        $settings->lettersPost_capacity = $request->letterPost_capacity;
        $settings->vat = $request->vat;
        $settings->save();
        return redirect()->back()->with('message','Data Save Successfully');
    }


    //---------------Security Settings----------//

    public function securitySettings(){

        $security = securitySettings::all();
        return view('admin.security',compact('security'));
    }
    public function saveSecurity(Request $request){
        $request->validate([
            'registeredParcel_price'=>'required',
            'insuranceBase_price'=>'required',
            'insurancePrice_slot'=>'required',
            'maximumInsurance_coverage'=>'required',
            'insurancePrice_hike_per_slot'=>'required'
        ]);

        $security = new securitySettings();
        $security->registeredParcel_price=$request->registeredParcel_price;
        $security->insuranceBase_price=$request->insuranceBase_price;
        $security->insurancePrice_slot=$request->insurancePrice_slot;
        $security->maximumInsurance_coverage=$request->maximumInsurance_coverage;
        $security->insurancePrice_hike_per_slot=$request->insurancePrice_hike_per_slot;
        $security->ekshop_parcel_charge=$request->ekshop_parcel_charge;
        $security->ekshop_letter_charge=$request->ekshop_letter_charge;
        $security->save();
        return redirect()->back()->with('message','Data Stored Successfully');
    }

    public function editSecurity($id){
        $data = securitySettings::where('id',$id)->get();
        return response()->json($data);

    }
    public function updateSecurity(Request $request,$id){
        $request->validate([
            'registeredParcel_price'=>'required',
            'insuranceBase_price'=>'required',
            'insurancePrice_slot'=>'required',
            'maximumInsurance_coverage'=>'required',
            'insurancePrice_hike_per_slot'=>'required'
        ]);

        $security = securitySettings::where('id',$id)->first();
        $security->registeredParcel_price=$request->registeredParcel_price;
        $security->insuranceBase_price=$request->insuranceBase_price;
        $security->insurancePrice_slot=$request->insurancePrice_slot;
        $security->maximumInsurance_coverage=$request->maximumInsurance_coverage;
        $security->insurancePrice_hike_per_slot=$request->insurancePrice_hike_per_slot;
        $security->ekshop_parcel_charge=$request->ekshop_parcel_charge;
        $security->ekshop_letter_charge=$request->ekshop_letter_charge;
        $security->save();
        return redirect()->back()->with('message','Data Stored Successfully');    
    }
    public function delete_security($id){
        securitySettings::where('id',$id)->delete();
        return redirect()->back()->with('message','Security Delete Successfully !!');
    }
}


