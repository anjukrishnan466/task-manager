<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { padding: 20px; }
        .highlight { background-color: #fff3cd !important; }
        .table td, .table th { vertical-align: middle; }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">Task Manager</h2>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('error') ?> </div>
    <?php endif; ?>

    <form class="row g-3 mb-4" method="post" action="<?= site_url('tasks/add') ?>">
        <div class="col-md-4">
            <input type="text" class="form-control" name="title" placeholder="Task title" required>
        </div>
        <div class="col-md-3">
            <input type="datetime-local" class="form-control" name="due_date" required>
        </div>
        <div class="col-md-2">
            <select class="form-select" name="priority">
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Add Task</button>
        </div>
    </form>

    <div class="card mb-3">
        <div class="card-body">
            <strong>Total:</strong> <?= $counts['total'] ?> &nbsp;|&nbsp;
            <strong>Completed:</strong> <?= $counts['completed'] ?> &nbsp;|&nbsp;
            <strong>Pending:</strong> <?= $counts['pending'] ?>
        </div>
    </div>

    <h4>Pending Tasks</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($tasks as $task): ?>
            <?php $highlight = (strtotime($task->due_date) - time() <= 86400) ? 'highlight' : ''; ?>
            <tr class="<?= $highlight ?>">
                <td><?= $task->title ?></td>
                <td><?= date('d M Y, h:i A', strtotime($task->due_date)) ?></td>
                <td><?= $task->priority ?></td>
                <td><a class="btn btn-success btn-sm" href="<?= site_url('tasks/complete/'.$task->id) ?>">Mark Completed</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>