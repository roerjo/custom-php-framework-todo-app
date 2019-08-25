<?php

namespace App\Controllers;

use App\Models\Task;

/**
 * Class: TaskController
 *
 */
class TaskController
{
    /**
     * Retrieve all tasks
     *
     */
    public function index()
    {
        $tasks = (new Task)->all();

        require '../app/views/index.php';
    }


    /**
     * Add a new task
     *
     */
    public function add()
    {
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];

        $task = [
            'title'         => $title,
            'description'   => $description,
            'completed'     => (int) false,
        ];

        (new Task)->create($task);

        header('Location: /');
    }

    /**
     * Remove a task
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        (new Task)->destroy($id);

        header('Location: /');
    }

    /**
     * Update a task
     *
     * @param int $id
     */
    public function update(int $id)
    {
        $task = [
            'completed_at' => date('Y-m-d H:i:s'),
        ];

        (new Task)->update($task, $id);

        header('Location: /');
    }
}
