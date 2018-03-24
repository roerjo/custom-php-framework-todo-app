<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class TaskControllerTest extends TestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = new Client([
            'base_uri' => 'http://todo.localhost:8000',
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
    }

    public function testItCompletesTask()
    {
        $response = $this->client->request('POST', '/complete/5');

        //die(var_dump($response->getBody()->getContents()));
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testItDeletesTask()
    {
        $response = $this->client->request('POST', '/delete/5');

        //die(var_dump($response->getBody()->getContents()));
        $this->assertEquals(200, $response->getStatusCode());
    }
}
