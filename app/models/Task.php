<?php

namespace App\Models;

use App\Database\QueryBuilder;

class Task
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

    public function all()
    {
        return $this->query->all('tasks');
    }

    public function create($attributes)
    {
        $this->query->insert('tasks', $attributes);
    }

    public function update($attributes, $id)
    {
        $this->query->update('tasks', $attributes, $id);
    }

    public function destroy($id)
    {
        $this->query->delete('tasks', $id);
    }
}
