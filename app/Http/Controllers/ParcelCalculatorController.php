<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\countrySetting;
use App\Models\securitySettings;
use App\Models\apiUser;
use App\Models\ipCheck;

class ParcelCalculatorController extends Controller
{
    public function getCountryList(Request $request)
    {
        // $info = $this->clientValidation($request);

        $clientName = $request->header('clientName');
        $accesToken = $request->header('accesToken');
        
        $api_user_data = apiUser::whereRaw("BINARY `access_token`= ?",[$accesToken])->first();
        
        if(is_null($api_user_data)){
            return response()->json(
                [
                    'code'=> 401,
                    'reason' => 'You are not Authorized'
                ],401
            );
        }
        
        if($api_user_data->is_active === 0){
            return response()->json(
                [
                    'code'=> 403,
                    'reason' => 'Your Access Token is not Active'
                ],403
            );
        }

        if($api_user_data->ip_check === 1){
            $ip_info = ipCheck::where('api_user_id', $api_user_data->id)
                        ->where('ip_address', $request->ip())
                        ->first();

            if(is_null($ip_info)){
                return response()->json(
                    [
                        'code'=> 401,
                        'reason' => 'UnAuthorized IP address'
                    ],401
                );
            }

            if($ip_info->is_active === 0){
                return response()->json(
                    [
                        'code'=> 403,
                        'reason' => 'Your IP address is not active'
                    ],403
                );
            }
        }
        
        $countryList = Country::get()->makeHidden(['id','airSurcharge' ]);

        return response()->json([
            'code'=>200,
            'data' => $countryList
        ],200);
    }

    
    public function APIdata(Request $request)
    {
        if(!$request->headers->has('clientName')){
            return response()->json([
                'code' => 401,
                'reason' => 'No client name'
            ],401);
        }

        if(!$request->headers->has('accesToken')){
            return response()->json([
                'code' => 401,
                'reason' => 'No access token'
            ],401);
        }

        $clientName = $request->header('clientName');
        $accesToken = $request->header('accesToken');
        
        $api_user_data = apiUser::whereRaw("BINARY `access_token`= ?",[$accesToken])->first();
        
        if(is_null($api_user_data)){
            return response()->json(
                [
                    'code'=> 401,
                    'reason' => 'You are not Authorized'
                ],401
            );
        }
        
        if($api_user_data->is_active === 0){
            return response()->json(
                [
                    'code'=> 403,
                    'reason' => 'Your Access Token is not Active'
                ],403
            );
        }

        if($api_user_data->ip_check === 1){
            $ip_info = ipCheck::where('api_user_id', $api_user_data->id)
                        ->where('ip_address', $request->ip())
                        ->first();

            if(is_null($ip_info)){
                return response()->json(
                    [
                        'code'=> 401,
                        'reason' => 'Un-authorized IP address'
                    ],401
                );
            }

            if($ip_info->is_active === 0){
                return response()->json(
                    [
                        'code'=> 403,
                        'reason' => 'Your IP address is not active'
                    ],403
                );
            }
        }

        if(!$request->has('country')) {
            return response()->json(
                [
                    'code'=> 206,
                    'reason' => 'country parameter missing'
                ],206
            );
        }

        if(!$request->has('weight')) {
            return response()->json(
                [
                    'code'=> 206,
                    'reason' => 'weight parameter missing'
                ],206
            );
        }

        if(!array_key_exists('is_regular', $request['security'])) {
            return response()->json(
                [
                    'code'=> 206,
                    'reason' => 'is_regular parameter missing'
                ],206
            );
        }

        if(!array_key_exists('is_registered', $request['security'])) {
            return response()->json(
                [
                    'code'=> 206,
                    'reason' => 'is_registered parameter missing'
                ],206
            );
        }

        if(!array_key_exists('is_insured', $request['security'])) {
            return response()->json(
                [
                    'code'=> 206,
                    'reason' => 'is_insured parameter missing'
                ],206
            );
        }

        if(!array_key_exists('insurance_value', $request['security'])) {
            return response()->json(
                [
                    'code'=> 206,
                    'reason' => 'insurance_value parameter missing'
                ],206
            );
        }
        
        $country = $request['country'];
        $weight = abs ($request['weight']);

        $is_regular = $request['security']['is_regular'];
        $is_registered = $request['security']['is_registered'];
        $is_insured = $request['security']['is_insured'];
        $insurance_value = abs ($request['security']['insurance_value']);

        $country_info = Country::where('country_name', strtolower($country))->first();

        if(is_null($country_info)){
            return response()->json(
                [
                    'code'=> 404,
                    'reason' => 'Country not matched'
                ],404
            );
        }

        if($weight < 1){
            return response()->json(
                [
                    'code'=> 422,
                    'reason' => 'weight must be greater than 0'
                ],422
            );
        }

        if(!in_array($is_regular,['0','1'])){
            return response()->json(
                [
                    'code'=> 422,
                    'reason' => 'Security is_regular must be boolean'
                ],422
            );
        }

        if(!in_array($is_registered,['0','1'])){
            return response()->json(
                [
                    'code'=> 422,
                    'reason' => 'Security is_registered must be boolean'
                ],422
            );
        }

        if(!in_array($is_insured,['0','1'])){
            return response()->json(
                [
                    'code'=> 422,
                    'reason' => 'Security is_insured must be boolean'
                ],422
            );
        }
        
        if(!in_array(1,[$is_regular, $is_registered, $is_insured ])){
            return response()->json(
                [
                    'code'=> 422,
                    'reason' => 'All value can\'t be 0'
                ],422
            );
        }        

        if($is_insured == 1){
            $is_registered = 1;
        }

        $companies = countrySetting::join('companies','country_settings.company_id','=','companies.id')
                        ->join('countries','country_settings.country_id','=','countries.id')
                        ->where('country_id',$country_info->id)
                        ->orderby('country_settings.id','asc')
                        ->get();

        
        $security = securitySettings::all();
   
            
        $is_avialble_ems = 0;
        $is_avialble_airmail = 0;
        $is_avialble_surfacemail = 0;

        $ekShop_parcel_charge = $security[0]->ekshop_parcel_charge;
        $ekShop_LDG_charge = $security[0]->ekshop_letter_charge;


        // return $security[0];

        foreach ($companies as $key => $value) {

            $calculated_insured_value = 0;
            $register_price = 0;

 
            if($weight >= $value->parcelPost_capacity * 1000){
                return response()->json('Parcel weight can\'t be over 20kg');
            }
                        
            if($is_regular == 1){

                if(strtolower($value->company_shortcode) == 'em'){
                    $sequreMoney = $security[0]->registeredParcel_price;
                    $register_price = $security[0]->registeredParcel_price;
                }

                $sequreMoney = 0;
            }

            if($is_registered == 1 && $is_insured ==0 ){
                $sequreMoney =  $security[0]->registeredParcel_price;
                $register_price = $security[0]->registeredParcel_price;
                
            }

            if($is_insured == 1){
                if($insurance_value > $security[0]->maximumInsurance_coverage){
                    return response()->json('Parcel insurance can\'t be over '. number_format($security[0]->maximumInsurance_coverage));
                }
                
                $sequreMoney = $security[0]->registeredParcel_price;

                $insuredPrev = 20;
  
                //per slot hike - 10
                $insured__ = $security[0]->insurancePrice_hike_per_slot;
                
                //no of slots
                $insurance_slot = ceil($insurance_value / $security[0]->insurancePrice_slot);                
                

                if($insurance_value>0){
                    $calculated_insured_value = $insuredPrev + 
                                                ($insured__ *($insurance_slot -1) + 
                                                $sequreMoney );
                }else{
                    $calculated_insured_value = $sequreMoney;
                }
            }


            if(strtolower($value->company_shortcode) == 'em'){

                // flag
                $is_avialble_ems = 1;

                $max_weight_parcel_ems = $value->parcelPost_capacity * 1000;
                $max_weight_letters_ems = $value->letterPost_capacity * 1000;

                //logistics name
                $esm_name = $value->name;

                //delivery days
                $ems_delivery_days = $value->delivery_days;
                
                // return the number of slots according to weight and slot size for the logistics
                $slot = ceil($weight / $value->parcel_weight_slot)-1; 
                
                


                $ems_security_amount = $register_price + $calculated_insured_value;

                $vat = ($sequreMoney + $value->parcel_base_price + ($value->parcel_hike_price * $slot))*15/100;
                
                $parcels_price['express_mail'] = $value->parcel_base_price + 
                                                    $register_price + 
                                                    $vat + 
                                                    ($value->parcel_hike_price * $slot) + 
                                                    $calculated_insured_value +
                                                    $ekShop_parcel_charge;
                                                    
                
                $letters_price['express_mail'] = 'N/A';
                $documents_price['express_mail'] = 'N/A';
                $goods_price['express_mail'] = 'N/A';
            }

            if(strtolower($value->company_shortcode) == 'am'){
                
                //flag
                $is_avialble_airmail = 1;

                $max_weight_parcel_airmail = $value->parcelPost_capacity * 1000;
                $max_weight_letters_airmail = $value->letterPost_capacity * 1000;

                //logistics name
                $air_mail_name = $value->name;

                //delivery days
                $air_mail_delivery_days = $value->delivery_days;
                
                //ok
                $air_mail_security_amount = $register_price + $calculated_insured_value;


                $parcel_slot = ceil($weight / $value->parcel_weight_slot);
                $letters_slot = ceil($weight / $value->letters_weight_slot);
                $documets_slot = ceil($weight / $value->documents_weight_slot);
                $goods_slot = ceil($weight / $value->goods_weight_slot);
                
                //If we calculate airSurcharge individually the use this block
/*              $letters_totalAirSurcharge = $value->airSurcharge * $letters_slot;
                $documets_totalAirSurcharge = $value->airSurcharge * $documets_slot;
                $goods_totalAirSurcharge = $value->airSurcharge * $goods_slot;
*/                
                
                $letters_totalAirSurcharge = $value->airSurcharge * $letters_slot;
                $documets_totalAirSurcharge = $value->airSurcharge * $letters_slot;
                $goods_totalAirSurcharge = $value->airSurcharge * $letters_slot;
                
                $parcel_slot = $parcel_slot - 1;
                $letters_slot = $letters_slot - 1;
                $documets_slot = $documets_slot - 1;
                $goods_slot = $goods_slot - 1;

                //ok
                $parcels_price['air_mail'] = $value->parcel_base_price + 
                                                    $register_price + 
                                                    ($value->parcel_hike_price * $parcel_slot) +  
                                                    $calculated_insured_value + 
                                                    $ekShop_parcel_charge;
                
                //ok
                $letters_price['air_mail'] = $value->letters_base_price + 
                                                    $register_price + 
                                                    ($value->letters_hike_price * $letters_slot) + 
                                                    $letters_totalAirSurcharge + 
                                                    $calculated_insured_value + 
                                                    $ekShop_LDG_charge;
                
                //ok
                $documents_price['air_mail'] = $value->documents_base_price + 
                                                    $register_price + 
                                                    ($value->documents_hike_price * $documets_slot) + 
                                                    $documets_totalAirSurcharge + 
                                                    $calculated_insured_value + 
                                                    $ekShop_LDG_charge;

                //ok
                $goods_price['air_mail'] = $value->goods_base_price + 
                                                    $register_price + 
                                                    ($value->goods_hike_price * $goods_slot) + 
                                                    $goods_totalAirSurcharge + 
                                                    $calculated_insured_value + 
                                                    $ekShop_LDG_charge;
            }
            
            if(strtolower($value->company_shortcode) == 'sm'){

                //flag
                $is_avialble_surfacemail = 1;

                $max_weight_parcel_surfacemail = $value->parcelPost_capacity * 1000;
                $max_weight_letters_surfacemail = $value->letterPost_capacity * 1000;

                $surface_mail_name = $value->name;
                $surface_mail_delivery_days = $value->delivery_days;
                $surface_mail_security_amount = $register_price + $calculated_insured_value;

                $parcel_slot = ceil($weight / $value->parcel_weight_slot);
                $letters_slot = ceil($weight / $value->letters_weight_slot);
                $documets_slot = ceil($weight / $value->documents_weight_slot);
                $goods_slot = ceil($weight / $value->goods_weight_slot);
                
                $parcel_slot = $parcel_slot - 1;
                $letters_slot = $letters_slot - 1;
                $documets_slot = $documets_slot - 1;
                $goods_slot = $goods_slot - 1;

                //ok
                $parcels_price['surface_mail'] = $value->parcel_base_price +
                                                        $register_price +
                                                        ($value->parcel_hike_price * $parcel_slot) +
                                                        $calculated_insured_value +
                                                        $ekShop_parcel_charge;

                //ok
                $letters_price['surface_mail'] = $value->letters_base_price +
                                                        $register_price +
                                                        ($value->letters_hike_price * $letters_slot) +
                                                        $calculated_insured_value +
                                                        $ekShop_LDG_charge;

                //ok
                $documents_price['surface_mail'] = $value->documents_base_price +
                                                            $register_price +
                                                            ($value->documents_hike_price * $documets_slot) +
                                                            $calculated_insured_value +
                                                            $ekShop_LDG_charge;

                //ok
                $goods_price['surface_mail'] = $value->goods_base_price +
                                                        $register_price +
                                                        ($value->goods_hike_price * $goods_slot) +
                                                        $calculated_insured_value +
                                                        $ekShop_LDG_charge;
            }
        }



        //final response
        $response = [
            'code' => 200,
            'request_data' => [
                'country'=> $country,
                'weight' => $weight,
                'security' =>[
                    'is_regular' => $is_regular,
                    'is_registerd' => $is_registered,
                    'is_insured' => $is_insured,
                    'insurance_value' => $insurance_value
                ],
            ],
            'response_data' => [
                'ems' => [
                    'is_available' => (($is_avialble_ems == 1) ? (1) : (0)),
                    'name' => (($is_avialble_ems == 1) ? ($esm_name) : ('')),
                    'delivery_day' => (($is_avialble_ems == 1) ? ($ems_delivery_days) : ('')),
                    'max_weight_parcel' => (($is_avialble_ems == 1) ? ($max_weight_parcel_ems) : (0)),
                    'max_weight_letters' => (($is_avialble_ems == 1) ? ($max_weight_letters_ems) : (0)),
                    'calculation' => [
                        'parcel' => (($is_avialble_ems == 1) ? ($parcels_price['express_mail']) : (0)),
                        'letter' => (($is_avialble_ems == 1) ? ($letters_price['express_mail']) : (0)),
                        'document' => (($is_avialble_ems == 1) ? ($documents_price['express_mail']) : (0)),
                        'goods' => (($is_avialble_ems == 1) ? ($goods_price['express_mail']) : (0)),
                        'security_amount' => (($is_avialble_ems == 1) ? ($ems_security_amount) : (0))
                    ],
                ],
                'airmail' => [
                    'is_available' => (($is_avialble_airmail == 1) ? (1) : (0)),
                    'name' => (($is_avialble_airmail == 1) ? ($air_mail_name) : ('')),
                    'delivery_day' => (($is_avialble_airmail == 1) ? ($air_mail_delivery_days) : ('')),
                    'max_weight_parcel' => (($is_avialble_airmail == 1) ? ($max_weight_parcel_airmail) : (0)),
                    'max_weight_letters' => (($is_avialble_airmail == 1) ? ($max_weight_letters_airmail) : (0)),
                    'calculation' => [
                        'parcel' => (($is_avialble_airmail == 1) ? ($parcels_price['air_mail']) : (0)),
                        'letter' => (($is_avialble_airmail == 1) ? ($letters_price['air_mail']) : (0)),
                        'document' => (($is_avialble_airmail == 1) ? ($documents_price['air_mail']) : (0)),
                        'goods' => (($is_avialble_airmail == 1) ? ($goods_price['air_mail']) : (0)),
                        'security_amount' => (($is_avialble_airmail == 1) ? ($air_mail_security_amount) : (0))
                    ],
                ],
                'surfacemail' => [
                    'is_available' => (($is_avialble_surfacemail == 1) ? (1) : (0)),
                    'name' => (($is_avialble_surfacemail == 1) ? ($surface_mail_name) : ('')),
                    'delivery_day' => (($is_avialble_surfacemail == 1) ? ($surface_mail_delivery_days) : ('')),
                    'max_weight_parcel' => (($is_avialble_surfacemail == 1) ? ($max_weight_parcel_surfacemail) : (0)),
                    'max_weight_letters' => (($is_avialble_surfacemail == 1) ? ($max_weight_letters_surfacemail) : (0)),
                    'calculation' => [
                        'parcel' => (($is_avialble_surfacemail == 1) ? ($parcels_price['surface_mail']) : (0)),
                        'letter' => (($is_avialble_surfacemail == 1) ? ($letters_price['surface_mail']) : (0)),
                        'document' => (($is_avialble_surfacemail == 1) ? ($documents_price['surface_mail']) : (0)),
                        'goods' => (($is_avialble_surfacemail == 1) ? ($goods_price['surface_mail']) : (0)),
                        'security_amount' => (($is_avialble_surfacemail == 1) ? ($surface_mail_security_amount) : (0))
                    ],
                ],
            ],
        ];

        $counter = $api_user_data->counter + 1;
        apiUser::where('id', $api_user_data->id)->update(['counter' => $counter]);

        return response()->json($response,200);
    }

    private function clientValidation($request)
    {
        $clientName = $request->header('clientName');
        $accesToken = $request->header('accesToken');

        
        $api_user_data = apiUser::whereRaw("BINARY `access_token`= ?",[$accesToken])->first();
        
        if(is_null($api_user_data)){
            return response()->json(
                [
                    'code'=> 401,
                    'reason' => 'You are not Authorized'
                ],401
            );
        }
        
        if($api_user_data->is_active === 0){
            return response()->json(
                [
                    'code'=> 403,
                    'reason' => 'Your Access Token is not Active'
                ],403
            );
        }

        if($api_user_data->ip_check === 1){
            $ip_info = ipCheck::where('api_user_id', $api_user_data->id)
                        ->where('ip_address', $request->ip())
                        ->first();

            if(is_null($ip_info)){
                return response()->json(
                    [
                        'code'=> 401,
                        'reason' => 'UnAuthorized IP address'
                    ],401
                );
            }

            if($ip_info->is_active === 0){
                return response()->json(
                    [
                        'code'=> 403,
                        'reason' => 'Your IP address is not Active'
                    ],403
                );
            }
        }
    }
}