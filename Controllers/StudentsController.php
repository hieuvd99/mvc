<?php

namespace mvc\Controllers;

use mvc\Core\Controller;
use mvc\Models\StudentModel;
use mvc\Models\StudentRepository;

class StudentsController extends Controller
{
    private $studentRepository;

    function __construct()
    {
        $this->studentRepository = new StudentRepository();
    }

    function index()
    {   
        $d['students'] = $this->studentRepository->getAll();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        $student = new StudentModel();
        extract($_POST);

        if (isset($name)) {
            $student->setName($name);
            $student->setAge($age);
            if ($this->studentRepository->add($student)) {
                header("Location: " . WEBROOT . "student/index");
            }
        }
        $this->render("create");
    }

    function edit($id)
    {
        extract($_POST);
        if (isset($name)) {
            $student = new StudentModel();
            $student->setId($id);
            $student->setName($title);
            $student->setAge($age);
            if ($this->studentRepository->update($student)) {
                header("Location: " . WEBROOT . "student/index");
            }
        }
        $d["student"] = $this->studentRepository->get($id);
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        if ($this->studentRepository->delete($id)) 
        {
            header("Location: " . WEBROOT . "student/index");
        }
    }
}
