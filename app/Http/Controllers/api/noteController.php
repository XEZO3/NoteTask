<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Repository\NoteRepository;
use Illuminate\Http\Request;

class noteController extends Controller
{
    protected $noteRepository;
    public function __construct(NoteRepository $noteRepository){
        $this->noteRepository = $noteRepository;
    }
    function getall(Request $req){
        $search = $req->input("search");
        $nots=null;
        if($search !=null){
            $nots = $this->noteRepository->getall(
                function ($query)use($search){
                    return $query->where("user_id",auth()->id())
                    ->where(function($query) use($search){
                        $query->where('note','LIKE', '%' . $search . '%')
                              ->orWhere('title','LIKE', '%' . $search . '%');
                    });
                }  
            );
        }else{
            $nots = $this->noteRepository->getall(
                function ($query){
                    return $query->where("user_id",auth()->id());
                }  
            );
        }
        
        return response()->json([
            'returnCode'=>200,
            'message'=>"",
            'result'=>$nots
        ],200);
    }
    function delete($id){
        $this->noteRepository->delete($id);
        return response()->json([
            'returnCode'=>200,
            'message'=>"note was deleted successfully",
            'result'=>""
        ],200);
    }
    function store(Request $req){
        $data = $req->validate([
            'title'=>"required",
            'note'=>"required"
        ]);
        $data['user_id']= auth()->id();
        $this->noteRepository->add($data);
        return response()->json([
            'returnCode'=>200,
            'message'=>"note was added successfully",
            'result'=>""
        ],200);
    }
    function getbyid($id){
        $note = $this->noteRepository->getById($id);
        return response()->json([
            'returnCode'=>200,
            'message'=>"",
            'result'=>$note 
        ],200); 
    }
    function update(Request $req,$id){
        $note = $this->noteRepository->getById($id);

        $data = $req->validate([
            'title'=>"required",
            'note'=>"required"
        ]);
        $note->update($data);
    }
    
}
