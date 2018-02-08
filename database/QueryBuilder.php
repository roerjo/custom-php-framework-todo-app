<?php

require 'Connection.php';

/**
 * Class: QueryBuilder
 *
 */
class QueryBuilder
{
    /**
     * Holds the PDO instance
     *
     * @var PDO
     */
    private $pdo;

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->pdo = Connection::make();
    }

    /**
     * Return all rows from the passed table
     *
     * @param string $table
     *
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
     * Insert a new row with the passed values into the passed table
     *
     * @param string $table
     * @param array $values
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
     * Delete the row with the passed id in the passed table
     *
     * @param string $table
     * @param int $id
     */
    public function delete(string $table, int $id)
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
     * values in the passed table
     *
     * @param string $table
     * @param array $values
     * @param int $id
     */
    public function update(string $table, array $values, int $id)
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

