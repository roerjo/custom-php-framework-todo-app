<?php

require 'Connection.php';

class QueryBuilder
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::make();
    }

    public function all($table)
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM {$table}");

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }

    public function insert($table, $values)
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES(%s)",
            $table,
            implode(', ', array_keys($values)),
            ':' . implode(', :', array_keys($values))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($values);
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }

    public function delete($table, $id)
    {
        try {
            $statement = $this->pdo->prepare(
                "DELETE FROM {$table} WHERE id = {$id}"
            );

            $statement->execute();
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }

    public function update($table, $values, $id)
    {
        try {
            $sql = sprintf(
                "UPDATE %s SET %s = %s, completed = 1 WHERE id = {$id}",
                $table,
                implode('', array_keys($values)),
                ':' . implode('', array_keys($values))
            );

            $statement = $this->pdo->prepare($sql);

            $statement->bindParam(
                ':dateCompleted',
                $values['dateCompleted'],
                PDO::PARAM_STR
            );

            $statement->execute();
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }
}

