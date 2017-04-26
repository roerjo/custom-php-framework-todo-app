<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Task Manager</title>

    <link rel="stylesheet" href="../public/css/main.css">

    <style>
        
        th, td {
            
        }

    </style>

</head>

<body>

    <div class="container">

        <section id="addTask">

            <h2>Add New Task</h2>

            <div class="row">

                <form action="/new" method="POST">
                    
                    <input type="text" name="title" placeholder="Title"/>
                    
                    <input type="text" name="description" placeholder="Description"/>

                    <button type="submit" id="enter">Add Task</button>

                </form>

            </div>

        </section>
        

        <section id="tasks">
        
            <h2>Tasks</h2>

            <div class="row">

                <table>
                    
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Description</th>
                            <th>Date Entered</th>
                            <th>Completed</th>
                            <th>Date Completed</th>
                            <th></td>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($tasks as $task) : ?>

                        <tr>    

                            <td><?= $task->title; ?></td>
                        
                            <td><?= $task->description; ?></td>

                            <td><?= $task->dateEntered; ?></td>

                            <td>
                        
                                <?php if ($task->completed) : ?>

                                    Done

                                <?php else : ?>

                                    Not Completed

                                <?php endif; ?>
                            
                            </td>

                            <td><?= $task->dateCompleted; ?></td>

                            <td>
                                <form action="/complete/<?= $task->id; ?>" method="POST">

                                    <button id="success">Complete</button>

                                </form>

                                <form action="/delete/<?= $task->id; ?>" method="POST">

                                    <button id="delete">Delete</button>

                                </form> 

                            </td>
                        
                        </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </section>

    </div>

</body>
</html>
