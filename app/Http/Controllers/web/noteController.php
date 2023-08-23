<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class noteController extends Controller
{
    public function index(){
        return view("note");
    }
    public function create(){
        return view("create");
    }
    public function update($id){
        return view("update",['id'=>$id]);
    }

}
