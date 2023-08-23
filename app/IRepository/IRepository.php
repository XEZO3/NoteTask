<?php
namespace App\IRepository;
interface IRepository{
    public function add($entity);
    public function delete($id);
    public function firstOrDefault($predicate = null, $include = null);
    public function getAll($predicate = null, $include = null);
    public function getById($id);
    public function update($entity);
}
?>