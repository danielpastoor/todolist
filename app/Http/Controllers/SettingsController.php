<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Settings;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userid = Auth::ID();
        $categorys = Settings::all()->where('userID', $userid)->toArray();
        return view('settings', compact('categorys'));
    }

    public function insert(Request $request){
        $userId = Auth::id();
        $name = $request->input('categoryname');
        $data=array("userID"=>$userId,"category"=>$name);

        if(DB::table('settings')->insert($data)){
            return redirect()->route('settings');
        }else{
            return redirect()->route('settings');
        }
    }

    public function delete($id){
        DB::table('settings')->where('id', $id)->delete();

        return redirect()->route('settings');
    }
}
