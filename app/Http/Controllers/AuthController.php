<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Transformers\UserTransformer;
use Auth;
use App\Blog;
use Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Create Register
    public function getRegister()
    {
        return view('register');
    }
    public function register(Request $request, User $user)
    {

        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' =>  'required|min:6|confirmed', // field_confirmation
        ]);

        $user = $user->create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'api_token' => bcrypt($request->email)
        ]);

        $response = fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();

        //return response()->json($response, 201);
        return redirect()->back();
    }

    public function getLogin()
    {
        return view('login.login');
    }

    public function login(Request $request, User $user)
    {
       
        if($request->isMethod('post')){    
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
               // return response()->json(['error' => 'Your credential is wrong'], 401);
               $user = $user->find(Auth::user()->id);
               Session::put('loginSession',$request->email);
                return redirect('admin/dashboard');
                return redirect()->route('admin');   
            } else {
                return redirect()->route('login')->witherror('Invalid Username Or Password');
            }

        return redirect()->route('login');
       }        
   
     /*   return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();
     */          
    }

    public function chkPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['id'=>'1'])->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else {
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $check_password = User::where(['email' => Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password,$check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('id','1')->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success','Password updated Successfully!');
            }else {
                return redirect('/admin/settings')->with('flash_message_error','Incorrect Current Password!');
            }
        }
    }
    
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->withsuccess('Logged Out Success');
    }
}
