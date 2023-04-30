<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(function ($request, $next) {


            if(Auth::check())
            {
                if(Auth()->user()->status == 2)
                {
                    return $next($request);
                }else{
                    return redirect()->route('home');
                }
            }else{
                return redirect()->route('login');
            }


        });
    }

    public function userlist()
    {
        $userlist = User::all();
        return view('admin.user')->with('userlist',$userlist);
    }
    public function adminadd($id)
    {
        $userData = User::where("id",$id);
        $getData = $userData->first();
        if($getData->id != 1)
        {
            $userData->update(["status"=>2]);
            return redirect('/userlist')->with('message', 'User permission added admin!');
        }else{
            return redirect('/userlist')->with('message', 'First admin not change!');
        }

    }
    public function useradd($id)
    {
        $userData = User::where("id",$id);
        $getData = $userData->first();
        if($getData->id != 1)
        {
            $userData->update(["status"=>1]);
            return redirect('/userlist')->with('message', 'User permission added normal user!');
        }else{
            return redirect('/userlist')->with('message', 'First admin not change!');
        }


    }
    public function activeuser($id)
    {
        $userData = User::where("id",$id);
        $getData = $userData->first();
        if($getData->id != 1)
        {
            $userData->update(["status"=>1]);
            return redirect('/userlist')->with('message', 'User activeted!');
        }else{
            return redirect('/userlist')->with('message', 'First admin not change!');
        }

    }
    public function banuser($id)
    {
        $userData = User::where("id",$id);
        $getData = $userData->first();
        if($getData->id != 1)
        {
            $userData->update(["status"=>0]);
            return redirect('/userlist')->with('message', 'User completely banned!');
        }else{
            return redirect('/userlist')->with('message', 'First admin not change!');
        }

    }
    public function suspenduser($id)
    {
        $userData = User::where("id",$id);
        $getData = $userData->first();
        if($getData->id != 1)
        {
            $userData->update(["status"=>3]);
            return redirect('/userlist')->with('message', 'User suspended!');
        }else{
            return redirect('/userlist')->with('message', 'First admin not change!');
        }

    }
}
