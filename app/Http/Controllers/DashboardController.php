<?php

namespace App\Http\Controllers;

use App\Models\Clockin;
use App\Models\SystemConfig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{


    public function Users(Request $request)
    {
        $users = User::latest()->simplePaginate(50);
        return view('backend.pages.users.index', compact('users'));
    }

    public function PostUsers(Request $request)
    {
        $data = $request->validate([
            'name' => 'required', 'email' => 'required|unique:users', 'password' => 'required', 'roleid' => 'required'
        ]);
        $data['password'] = Hash::make($data['password']);
        if($request->profile_image) {
            $path = Storage::disk('do')->put('rayfordFord/profiles', request()->profile_image, 'public');
            $data['profile_photo'] = $path;
        }
        User::create($data);

        $request->session()->flash('alert-success', 'Staff successfully created!');
        return back();
    }

    public function EditUsers(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('backend.pages.users.edit', compact('user'));
    }
    public function UpdateUsers(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required', 'email' => 'required', 'roleid' => 'required'
        ]);
        if($request->password && $request->password != null) {
            $data['password'] = Hash::make($request->password);
        }
        if($request->profile_image) {
            $path = Storage::disk('do')->put('rayfordFord/profiles', request()->profile_image, 'public');
            $data['profile_photo'] = $path;
        }
        $user->update($data);
        $request->session()->flash('alert-success', 'Staff successfully updated!');
        return back();
    }

    public function DeleteUser(Request $request, $id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();
        $logs = Clockin::where('user_id', $id)->get();
        foreach ($logs as $key => $log) {
            $log->delete();
        }

        $request->session()->flash('alert-success', 'Staff account successfully deleted!');
        return back();
    }

    public function Configs(Request $request)
    {
        $config = SystemConfig::first();
        return view('backend.pages.admin.configs', compact('config'));
    }

    public function PostConfigs(Request $request)
    {
        // ddd($request->all());
        $data = $request->validate([
            'longitude' => 'required', 'latitude' => 'required', 'required_km' => 'required'
        ]);
        $config = SystemConfig::first();
        if($config){
            $config->update($data);
        }else{
            SystemConfig::create($data);
        }
        $request->session()->flash('alert-success', 'New Configuration updated!');
        return back();
    }

    public function Clockins(Request $request)
    {
        $clockins = Clockin::latest()->simplePaginate(60);
        return view('backend.pages.clockins.index', compact('clockins'));
    }


}
