<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>Task Manager</title>

    <style>
        
        th, td {
            min-width: 100px;
            text-align: center;
        }

    </style>

</head>
<body>

    <h2>Add New Task</h2>

    <form action="/new" method="POST">
        
        <input type="text" name="title" placeholder="Title"/>
        
        <input type="text" name="description" placeholder="Description"/>

        <button type="submit">Add Task</button>

    </form>

    <h2>Tasks</h2>
    
    <table>
        
        <thead>

            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Date Entered</th>
                <th>Completed</th>
                <th>Date Completed</th>
                <th></td>
                <th></td>
            <tr>

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

                        <button>Complete</button>

                    </form>

                </td>

                <td>

                    <form action="/delete/<?= $task->id; ?>" method="POST">

                        <button>Delete</button>

                    </form>                    

                </td>
            
            </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</body>
</html>
