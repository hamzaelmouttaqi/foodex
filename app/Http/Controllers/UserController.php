<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\USERS;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        
        return view('employe.index', ['users' => $model->whereHas(
            'roles', function($q){
                $q->whereIn('role_id',['1','2']);
            })->paginate(10)]);
    }
   
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        DB::table('users')->delete($id);
        return redirect()->route('employe.index')->with(["succes"=>"employe supprimer avec succes"]) ;
    }
}
