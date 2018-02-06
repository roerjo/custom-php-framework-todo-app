<?php

class TaskController
{
    public function index()
    {
        $query = new QueryBuilder;

        $tasks = $query->all('tasks');

        require '../views/index.php';
    }


    public function add()
    {
        $dateFormat = 'Y-m-d';
        $date = date($dateFormat);
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];

        $task = [
            'title' => $title,
            'description' => $description,
            'completed' => (int) false,
            'dateEntered' => $date
        ];

        $query = new QueryBuilder;

        $query->insert('tasks', $task);

        header('Location: /');
    }

    public function delete($id)
    {
        $query = new QueryBuilder;

        $query->delete('tasks', $id);

        header('Location: /');
    }

    public function update($id)
    {
        $query = new QueryBuilder;

        $dateFormat = 'Y-m-d';

        $date = date($dateFormat);

        $task = [
            'dateCompleted' => $date,
        ];

        $query->update('tasks', $task, $id);

        header('Location: /');
    }
}

