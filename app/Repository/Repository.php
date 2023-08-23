<?php

namespace App\Repository;
use App\IRepository\IRepository;

class Repository implements IRepository{
protected $object;
    public function __construct($object){
    $this->object = $object;
    }
    public function add($entity){
       return $this->object::create($entity);
    }
    public function delete($id){
        $obj = $this->object::find($id);
        if ($obj) {
            $obj->delete();
            return true;        
        }
        return false;
        
    }
    public function firstOrDefault($predicate = null, $include = null){
        $obj = $this->object;
        if($include !=null){
        $obj = $include($obj);
        }
        if ($predicate != null) {
            $obj = $predicate($obj);
        }
        return $obj?->first();
    }
    public function getAll($predicate = null, $include = null){
        $obj = $this->object;
        if($include !=null){
        $obj = $include($obj);
        }
        if ($predicate != null) {
            $obj = $predicate($obj);
        }
        return $obj?->get();
    }
    public function getById($id){
        return $this->object::find($id);

    }
    public function update($entity){
       return $this->object::create($entity);
    
    }

}