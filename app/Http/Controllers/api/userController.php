<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class userController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
  
    public function login(Request $req){
        $data = $req->validate([
            'email'=>"required|email",
            'password'=>"required"
        ]);
        $user = $this->userRepository->firstOrDefault(
            function ($query) use ($data){
                return $query->where("email",$data['email']);
            }
        );

        if($user && Hash::check($data['password'],$user->password)){
            $token = JWTAuth::fromUser($user);        
            return response()->json(['token' => $token]);
           }else{
            return response()->json(['message' => "Username or password incorrect"], 401);
        }
       
    }
    public function register(Request $req){
        $data = $req->validate([
            'email'=>"required|email",
            'password'=>"required",
            'name'=>"required|min:4"
        ]);
        $data['password'] = Hash::make( $data['password']);
         $this->userRepository->add($data);
        redirect("/login");

    }
    public function logout(){
        Session::forget('user_id');

    }
}
