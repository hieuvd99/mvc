<?php

namespace mvc\Controllers;

use mvc\Core\Controller;
use mvc\Models\TaskModel;
use mvc\Models\TaskRepository;

class TasksController extends Controller
{
    private $taskRepository;

    function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    function index()
    {   
        $d['tasks'] = $this->taskRepository->getAll();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        $task = new TaskModel();
        extract($_POST);

        if (isset($title)) {
            $task->setTitle($title);
            $task->setDescription($description);
            if ($this->taskRepository->add($task)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->render("create");
    }

    function edit($id)
    {
        extract($_POST);
        if (isset($title)) {
            $task = new TaskModel();
            $task->setId($id);
            $task->setTitle($title);
            $task->setDescription($description);
            if ($this->taskRepository->update($task)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $d["task"] = $this->taskRepository->get($id);
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        if ($this->taskRepository->delete($id)) 
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
