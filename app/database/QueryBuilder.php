<?php

namespace App\Database;

use PDO;

class QueryBuilder
{
    /**
     * Database connection.
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Setup QueryBuilder.
     */
    public function __construct()
    {
        $this->pdo = Connection::make();
    }

    /**
     * Run migration to create tasks table.
     *
     * @return void
     */
    public function migrate(): void
    {
        switch ($_ENV['DATABASE_DRIVER']) {
            case 'mysql':
                $path = 'create_tasks_table_20190924072400.sql';
                break;
            case 'sqlite':
                $path = 'sqlite/create_tasks_table_20190924072400.sql';
                break;
        }

        $create_tasks_table = file_get_contents(__DIR__.'/../../migrations/'.$path);

        try {
            $statement = $this->pdo->prepare($create_tasks_table);
            $statement->execute();
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }

    /**
     * Return all rows from the passed table.
     *
     * @param  string  $table
     * @return array
     */
    public function all(string $table): array
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM {$table}");

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }

    /**
     * Insert a new row with the passed values into the passed table.
     *
     * @param  string  $table
     * @param  array  $values
     * @return void
     */
    public function insert(string $table, array $values)
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

    /**
     * Delete the row with the passed id in the passed table.
     *
     * @param  string  $table
     * @param  int  $id
     * @return void
     */
    public function delete(string $table, int $id): void
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

    /**
     * Update the row with that holds the passed id with the passed
     * values in the passed table.
     *
     * @param  string  $table
     * @param  array  $values
     * @param  int  $id
     * @return void
     */
    public function update(string $table, array $values, int $id): void
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
                ':completed_at',
                $values['completed_at'],
                PDO::PARAM_STR
            );

            $statement->execute();
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }
}
