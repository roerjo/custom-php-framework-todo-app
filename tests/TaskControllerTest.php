<?php

namespace Tests;

use App\Models\Task;

class TaskControllerTest extends TestCase
{
    /**
     * @test
     * @runInSeparateProcess
     */
    function it_creates_task()
    {
        $task = [
            'title' => 'I dont wanna',
            'description' => 'Tough task description',
        ];

        $this->request(
            '/new',
            'POST',
            $task
        );

        $tasks = (new Task)->all();

        $this->assertCount(1, $tasks);
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    function it_completes_task()
    {
        $task = new Task;

        $task->create([
            'title' => 'Incomplete Task',
            'description' => 'Finish Me!',
            'completed' => (int) false,
        ]);

        $id = $task->all()[0]->id;

        $this->request("/complete/{$id}", 'POST');

        $result = $task->all()[0]->completed;

        $this->assertEquals(true, $result);
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    function it_deletes_task()
    {
        $task = new Task;

        $task->create([
            'title' => 'Incomplete Task',
            'description' => 'Finish Me!',
            'completed' => (int) false,
        ]);

        $id = $task->all()[0]->id;

        $this->request("/delete/{$id}", 'POST');

        $this->assertCount(0, $task->all());
    }
}
