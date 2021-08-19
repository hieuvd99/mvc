<?php

namespace mvc\Core;

use mvc\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface
{

    private $table;
    private $id;
    private $model;

    //Dùng _init($table, $id, $model) để lấy tên bảng và các dữ liệu khác
    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_CLASS, get_class($this->model));
    }

    public function get($id)
    {
        $class = get_class($this->model);
        $sql = "SELECT * FROM $this->table WHERE $this->id = $id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return ($req->fetchObject($class));
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE $this->id = $id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function save($model)
    {
        //Đổi object  $model thành array (key-value) với hàm getProperties(). Ví dụ $arrayModel.
        $arrData = $model->getProperties();
        $arrKey = [];
        foreach($arrData as $key=>$value)
        {
            array_push($arrKey, $key.' = :'.$key);
        }
        $stringModel = implode(', ', $arrKey);
        if($model->getId() === null)
        {
            $sql = "INSERT INTO $this->table SET $stringModel";
            
        }
        else 
        {
            $sql = "UPDATE $this->table SET $stringModel WHERE $this->id=:id";  
        }
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($arrData);
    }
   
}
