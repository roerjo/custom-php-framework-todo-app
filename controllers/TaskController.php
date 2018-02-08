<?php

/**
 * Class: TaskController
 *
 */
class TaskController
{
    /**
     * Holds the QueryBuilder instance
     *
     * @var mixed
     */
    private $query;

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->query = new QueryBuilder;
    }

    /**
     * Retrieve all tasks
     *
     */
    public function index()
    {
        $tasks = $this->query->all('tasks');

        require '../views/index.php';
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
            'title' => $title,
            'description' => $description,
            'completed' => (int) false,
            'dateEntered' => date('Y-m-d'),
        ];

        $this->query->insert('tasks', $task);

        header('Location: /');
    }

    /**
     * Remove a task
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->query->delete('tasks', $id);

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
            'dateCompleted' => date('Y-m-d'),
        ];

        $this->query->update('tasks', $task, $id);

        header('Location: /');
    }
}

