<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)

    {      
        if(($data['nom'])){
          $nom=$data['nom'];
            $prenom=$data['prenom'];
            $email=$data['email'];
            $tele=$data['tele'];
            $date_de_naissance=$data['date_naissance'];
            $code_postal=$data['code_postal'];
            $adresse=$data['adresse'];
        $client=Client::create([
            "nom"=>$nom ,
            "Prenom"=>$prenom,
            "email"=>$email,
            "tele"=>$tele,
            "date_de_naissance"=>$date_de_naissance,
            "code_postal"=>$code_postal,
            "adresse"=>$adresse,
        ]);
        $id_client=Client::latest()->first()->id;
        $user=User::create([
            'id_client'=>$id_client,
            'name' => $data['nom'].' '.$data['prenom'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    else{
        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            
        ]);
    }
        
        return ($user);
        // Auth::login($user=User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]));
        // $user->attachRole($data['role_id']);
        
        // return redirect(RouteServiceProvider::HOME);
    }
}
