<?php
namespace App\Repository;

use App\IRepository\IUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository implements IUserRepository{
    private $user;
    public function __construct(){
         $user = new User();
         $this->user = $user;
        parent::__construct($user);
    }
    
} 