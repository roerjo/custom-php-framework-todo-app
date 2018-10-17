<?php

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use App\Database\Connection;
use PHPUnit\Framework\TestCase;

class TaskControllerTest extends TestCase
{
    protected $client;
    protected static $id;

    public function setUp()
    {
        parent::setUp();

        (new Dotenv('.'))->load();

        $this->client = new Client([
            'base_uri' => $_ENV['BASE_URI'],
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

        $pdo = Connection::make();
        $statement = $pdo->prepare("
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
