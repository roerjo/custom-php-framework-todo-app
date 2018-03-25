<?php

use GuzzleHttp\Client;
use App\Database\Connection;
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

class TaskControllerTest extends TestCase
{
    use TestCaseTrait;

    private static $pdo = null;
    private $conn = null;
    protected $client;
    protected static $id;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo === null) {
                self::$pdo = Connection::make();
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, 'todo');
        }

        return $this->conn;
    }

    public function getDataset()
    {
        return $this->createArrayDataSet([]);
    }

    public function setUp()
    {
        parent::setUp();

        $this->client = new Client([
            'base_uri' => 'http://todo.localhost',
        ]);
    }

    public function testItRetrievesFromIndex()
    {
        $response = $this->client->request('GET', '/');

        //die(var_dump($response->getBody()->getContents()));
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testItCreatesTask()
    {
        $task = [
            'title'         => 'I don\'t wanna',
            'description'   => 'Tough task description',
        ];

        $response = $this->client->request(
            'POST',
            '/new',
            ['form_params' => $task]
        );

        //die(var_dump($response->getBody()->getContents()));
        $this->assertEquals(200, $response->getStatusCode());

        $statement = self::$pdo->prepare("
                SELECT id FROM tasks WHERE title = 'I don\'t wanna'
        ");

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        self::$id = array_pop($results)->id;
    }

    public function testItCompletesTask()
    {
        $response = $this->client->request('POST', '/complete/'.self::$id);

        //die(var_dump($response->getBody()->getContents()));
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testItDeletesTask()
    {
        $response = $this->client->request('POST', '/delete/'.self::$id);

        //die(var_dump($response->getBody()->getContents()));
        $this->assertEquals(200, $response->getStatusCode());
    }
}
