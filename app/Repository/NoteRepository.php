<?php
namespace App\Repository;

use App\IRepository\INoteRepository;
use App\Models\Note;

class NoteRepository extends Repository implements INoteRepository{
    public function __construct(){
         $note = new Note();
        parent::__construct($note);
    }
} 