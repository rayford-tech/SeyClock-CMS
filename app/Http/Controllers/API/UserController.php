<?php

namespace App\Http\Controllers\API;

// use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessImageUpload;
use App\Models\Clockin;
use App\Models\SystemConfig;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    public $token = 'z%C*F-JaNdRfUjXn2r5u8x/A?D(G+KbPeShVkYp3s6v9y$B&E)H@McQfTjWnZq4t';

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken($this->token)-> accessToken;
            $success['user'] =  $user;
            $config = SystemConfig::first();
            $success['config'] =  $config ?? [];
            if(!$user->active) {
                return response()->json(['error'=>'inactive'], 401);
            }
            return response()->json(['success' => $success], $this-> successStatus);

        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    public function configs(Request $request){
        $config = SystemConfig::first();
        $user = User::find(Auth::id());
        $clockin = Clockin::where('user_id', $user->id)->whereNull('clockout')->latest()->limit(1)->get();
        $success['config'] =  $config ?? [];
        $success['clockin'] =  $clockin ?? [];
        $success['user'] =  $user;
        return response()->json(['success' => $success], $this-> successStatus);
    }

    protected function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }



    public function register(Request $request)
    {


        $data = $request->validate([
            'name' => 'required', 'email' => 'required|unique:users', 'dob' => '', 'gdc_number' => 'required',
            'telephone' => '', 'skill' => ''
        ]);
        $user = User::create([
            'name' => $data['name'], 'email' => $data['email'], 'telephone' => $data['telephone'], 'role' => $data['skill'],
            'password' => Hash::make($data['gdc_number']), 'active' => 0
        ]);
        if($user):
            $pdata = [
                'user_id' => $user->id, 'gdc_number' => $data['gdc_number'], 'dob' => Carbon::parse($data['dob'])
            ];

            if($request->profile_image):
                $path = Storage::disk('do')->put('profiles', request()->profile_image, 'public');
                $pdata['profile_image'] = $path;
            endif;
            $profile = UserProfile::create($pdata);
        endif;
        $success['token'] =  $user->createToken($this->token)-> accessToken;
        $success['user'] =  $user;
        return response()->json(['success'=>$success], $this->successStatus);
    }


    public function details()
    {
        $user = User::with(['profile'])->find(Auth::id());
        $success['user'] =  $user;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function UpdateUserProfile(Request $request)
    {
        // return response()->json(['success'=>$request->all()], 401);
        $user = User::with(['profile'])->find(Auth::id());

        // $validator = Validator::make($request->all(), [
        //     'name' => ['required', 'string', 'max:255'],
        //     'telephone' => ['string', 'min:9'],
        //     'dob' => ['string']
        // ]);
        $data = $request->validate([
            'name' => 'required', 'telephone' => '', 'dob' => '', 'gdc_number' => 'required', 'address' => ''
        ]);
        // if ($validator->fails()) {
        //     return response()->json(['error'=>$validator->errors()], 401);
        // }
        // $data = $request->all();
        $user->update([
            'name' => $data['name'], 'telephone' => $data['telephone'],
            'password' => Hash::make($data['gdc_number'])
        ]);
        $profile = UserProfile::where('user_id', $user->id)->first();
        // dd($profile);
        $profile->update(['gdc_number' => $data['gdc_number'], 'address' => $data['address']]);
        if($request->dob){
            // $profile->dob
            $profile->update(['dob' => Carbon::parse($request->dob)]);
        }
        if($request->profile_image):
            $path = Storage::disk('do')->put('profiles', request()->profile_image, 'public');
            $profile->profile_image = $path;
            $profile->save();
        endif;
        $user = User::with(['profile'])->find(Auth::id());
        $success['user'] =  $user;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function Clockin(Request $request)
    {
        $user = User::find(Auth::id());
        $data = $request->validate([
            'clockin' => 'required',
            // 'photo' => 'image|mimes:jpg,png,jpeg,gif,svg'
        ]);
        $data['clockin'] = \Carbon\Carbon::parse($data['clockin']);
        $data['user_id'] = $user->id;
        $data['ip'] = $request->ip();

        // if($request->photo):
        //     $path = Storage::disk('do')->put('rayfordFord/clockins', request()->photo, 'public');
        //     $data['photo'] = $path;
        //  endif;

         $clockin = Clockin::create($data);
        // $clockin2 = Clockin::where('user_id', $user->id)->whereNull('clockout')->latest()->limit(1)->get();

        $success['clockin'] =  $clockin;
        return response()->json(['success' => $success], $this->successStatus);
    }
    public function Clockout(Request $request, $id)
    {
        $user = User::find(Auth::id());
        $data = $request->validate([
            'clockout' => 'required'
        ]);
        $clockin = Clockin::findOrFail($id);
        $clockin->update([
            'clockout' => \Carbon\Carbon::parse($data['clockout'])
        ]);
        $clockin2 = Clockin::where('user_id', $user->id)->whereNull('clockout')->latest()->limit(1)->get();
        $success['clockin'] =  [];
        return response()->json(['success' => $success], $this->successStatus);
    }



}
