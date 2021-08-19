<?php

namespace mvc\Models;

use mvc\Core\Model;
use mvc\Models\StudentResourceModel;

class StudentRepository
{
    protected $studentRes;
    public function __construct()
    {
        $this->studentRes = new StudentResourceModel();
    }

    public function getAll(){
        return $this->studentRes->getAll();
    }

    public function get($id){
        return $this->studentRes->get($id);
    }

    public function delete($id){
        return $this->studentRes->delete($id);
    }

    public function add(StudentModel $model){
        return $this->studentRes->save($model);
    }

    public function update(StudentModel $model){
        return $this->studentRes->save($model);
    }
}
