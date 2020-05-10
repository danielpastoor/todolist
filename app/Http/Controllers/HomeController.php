<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        $todo = Todo::all()->where('userID', $userid)->sortBy('enddate')->toArray();
        $finshed = DB::select('select * from `todo` where `userID` = 1 and `done` = 1');
        $categorys = Settings::all()->where('userID', $userid)->toArray();

        return view('home', compact('todo', 'finshed', 'categorys'));
    }

    public function update(Request $request){
        $taskid = $request->input('taskid');
        $task_name = $request->input('taskname');
        $enddate = $request->input('enddate');
        $content = $request->input('content');
        if(DB::table('todo')->where('id', $taskid)->update(['name' => $task_name, 'content' => $content, 'enddate' => $enddate])){
            return redirect()->route('home');
        }else{
            return redirect()->route('home');
        }
    }
    public function delete($id){
        DB::table('todo')->where('id', $id)->delete();
        
        
        return redirect()->route('home');
    }

    public function insert(Request $request){
        $userId = Auth::id();
        $task_name = $request->input('taskname');
        $enddate = $request->input('enddate');
        $category = $request->input('selector');
        $content = $request->input('content');
        $data=array("userID"=>$userId,"name"=>$task_name,"category"=>$category,"content"=>$content,"enddate"=>$enddate,"done"=>"0");

        if(DB::table('todo')->insert($data)){
            return redirect()->route('home');
        }else{
            return redirect()->route('home');
        }
    }

    public function updatestatus(Request $request){
        $itemid = $request['itemID'];
        $status = $request['status'];
        if(DB::table('todo')->where('id', $itemid)->update(['done' => $status])){
            return redirect()->route('home');
        }else{
            return redirect()->route('home');
        }
    }
}
