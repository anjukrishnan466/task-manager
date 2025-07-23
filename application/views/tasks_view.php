<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { padding: 20px; background-color:#f8f9fa; }
        .highlight { background-color:#fff3cd !important; }
        .priority-low { background-color:#e6f9e6; }
        .priority-medium { background-color:#fff8e1; }
        .priority-high { background-color:#fce4ec; }
        .completed { text-decoration: line-through; color: gray; }
        .table td, .table th { vertical-align: middle; }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">Task Manager</h2>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('error') ?> </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?> </div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-body">
            <strong>Total:</strong> <?= $counts['total'] ?> &nbsp;|&nbsp;
            <strong>Completed:</strong> <?= $counts['completed'] ?> &nbsp;|&nbsp;
            <strong>Pending:</strong> <?= $counts['pending'] ?>
        </div>
    </div>

    <form method="get" class="mb-3">
        <div class="row g-2">
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="pending" <?= $status == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="completed" <?= $status == 'completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="all" <?= $status == 'all' ? 'selected' : '' ?>>All</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="due_date" <?= $sort == 'due_date' ? 'selected' : '' ?>>Due Date</option>
                    <option value="priority" <?= $sort == 'priority' ? 'selected' : '' ?>>Priority</option>
                    <option value="title" <?= $sort == 'title' ? 'selected' : '' ?>>Title</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="order" class="form-select" onchange="this.form.submit()">
                    <option value="asc" <?= $order == 'asc' ? 'selected' : '' ?>>Ascending</option>
                    <option value="desc" <?= $order == 'desc' ? 'selected' : '' ?>>Descending</option>
                </select>
            </div>
        </div>
    </form>

    <a href="<?= site_url('tasks/add') ?>" class="btn btn-primary mb-3">+ Add Task</a>

    <h4><?= ucfirst($status) ?> Tasks</h4>
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
            <?php
                $now = time();
                $dueTimestamp = strtotime($task->due_date);
                $isDueSoon = ($dueTimestamp >= $now && $dueTimestamp <= ($now + 86400)); // next 24 hrs
                $highlight = ($isDueSoon && $task->status == 'pending') ? 'highlight' : '';
                $priorityClass = 'priority-' . strtolower($task->priority);
                $rowClass = trim($highlight . ' ' . $priorityClass);
                if ($task->status == 'completed') {
                    $rowClass .= ' completed';
                }
            ?>
            <tr class="<?= $rowClass ?>">
                <td><?= htmlspecialchars($task->title) ?></td>
                <td>
                    <?= date('d M Y, h:i A', strtotime($task->due_date)) ?>
                    <?php if ($isDueSoon && $task->status == 'pending'): ?>
                        <span class="badge bg-warning text-dark ms-2"> Due Soon</span>
                    <?php endif; ?>
                </td>
                <td><?= ucfirst($task->priority) ?></td>
                <td>
                    <?php if ($task->status == 'pending'): ?>
                        <a class="btn btn-success btn-sm" href="<?= site_url('tasks/complete/'.$task->id) ?>">Mark Completed</a>
                    <?php else: ?>
                        <span class="badge bg-secondary">Done</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
