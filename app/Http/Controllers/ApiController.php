<?php

namespace App\Http\Controllers;

use App\Models\apiUser;
use App\Models\ipCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiController extends Controller
{

    // Api User Controller
    public function index(){
        $api_user_data = apiUser::all();
        return view('admin.api_user_view',compact('api_user_data'));
    }

    public function create(Request $request){
        $api_user = new apiUser();
        $this->validate($request,[
            'api_username' => 'required|string|unique:api_users'
        ]);

        $api_user->api_username = $request->api_username;
        $string = preg_replace('/\s+/', '', $request->api_username);
        $access_token = $string.'-'.Str::random(10);
        $api_user->access_token = $access_token;

        $api_user->save();
        return redirect()
                ->back()
                ->with('message','User Add Successfully');
    }

    public function delete($id){
        $delete_user = apiUser::where('id',$id)->delete();
        return redirect()
                ->back()
                ->with('delete','User Delete Successfully');
    }

    public function edit($id){
        $api_user_response = apiUser::where('id',$id)->first();
        return response()->json($api_user_response);
    }
    public function update(Request $request , $id){
        $update_user = apiUser::where('id',$id)->first();

        $update_user->api_username = $request->user_name;
        $update_user->access_token = $request->access_token;
        $update_user->is_active = $request->is_active;
        $update_user->ip_check = $request->ip_check;
        
        $update_user->update();

        return redirect()
                ->back()
                ->with('message','User Update Successfully');
    }

    // Api user Ip check Controller
    public function ip_add(){
        $user_api = apiUser::all();
        return view('admin.ip_add',compact('user_api'));
    }
    public function ip_create(Request $request){
        $ip_data = new ipCheck();
        $this->validate($request,[
            'ip_address' => 'required',
            'api_user_id' => 'required'
        ]);
        $ip_data -> ip_address = $request -> ip_address;
        $ip_data -> api_user_id = $request -> api_user_id;

        $ip_data->save();

        return redirect()
                ->back()
                ->with('success','IP Added Successfully !!');
    }

    public function ip_edit($id){
        $ip_list = ipCheck::where('api_user_id',$id)->with('apiUser')->get();
        return response()->json($ip_list);
    }

    public function edit_status_active($id){
        $ip_lists = ipCheck::where('id',$id)->first();

        $ip_lists->is_active = 1;
        $ip_lists->update();
        return redirect()
                ->back();
    }
    public function edit_status_disable($id){
        $ip_lists = ipCheck::where('id',$id)->first();

        $ip_lists->is_active = 0;
        $ip_lists->update();
        return redirect()
                ->back();
    }
}
