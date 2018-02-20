<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Task Manager</title>

    <link rel="stylesheet" href="css/main.css">

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

<script>

    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-90488436-1', 'auto');
    ga('send', 'pageview');

</script>
</html>
