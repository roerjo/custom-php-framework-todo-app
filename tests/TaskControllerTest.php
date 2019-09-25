<?php

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use App\Database\QueryBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class TaskControllerTest extends TestCase
{
    protected $client;
    protected static $id = 1;
    private static $process;

    public static function setUpBeforeClass()
    {
        self::$process = new Process("nohup php -S localhost:8080 -t public public/index.php > phpd.log 2>&1 &");
        self::$process->start();
        usleep(100000); //wait for server to get going

        copy('.env', '.env.temp');
        copy('.env.ci', '.env');

        (new Dotenv('.', '.env.ci'))->load();

        (new QueryBuilder)->migrate();
    }

    public static function tearDownAfterClass()
    {
        self::$process->stop();

        copy('.env', '.env.ci');
        copy('.env.temp', '.env');
    }

    public function setUp()
    {
        parent::setUp();

        $this->client = new Client([
            'base_uri' => $_ENV['BASE_URI'],
            'http_errors' => false,
        ]);
    }

    public function testItRetrievesFromIndex()
    {
        $response = $this->client->get('/');

        //$this->assertEquals(200, $response->getStatusCode());
    }

    public function testItCreatesTask()
    {
        $task = [
            'title'         => 'I dont wanna',
            'description'   => 'Tough task description',
        ];

        $response = $this->client->request(
            'POST',
            '/new',
            ['form_params' => $task]
        );

        //die(var_dump($response->getBody()->getContents()));
        //$this->assertEquals(200, $response->getStatusCode());
    }

    public function testItCompletesTask()
    {
        $response = $this->client->request('POST', '/complete/'.self::$id);

        //die(var_dump($response->getBody()->getContents()));
        //$this->assertEquals(200, $response->getStatusCode());
    }

    public function testItDeletesTask()
    {
        $response = $this->client->request('POST', '/delete/'.self::$id);

        //die(var_dump($response->getBody()->getContents()));
        //$this->assertEquals(200, $response->getStatusCode());
    }
}
