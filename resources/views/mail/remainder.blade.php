<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Reminder</title>
</head>
<body>
    <h2>Task Reminder</h2>
    <p>Hello {{ $task->user->name }},</p>
    <p>This is a reminder that your task "{{ $task->name }}" is due soon. Please complete it on time.</p>
    <p>Task Details:</p>
    <ul>
        <li>Task Name: {{ $task->name }}</li>
        <li>Description: {{ $task->description }}</li>
        <li>Due Date: {{ $task->due_date->format('Y-m-d H:i') }}</li>
    </ul>
    <p>Regards,<br>Your Task Management System</p>
</body>
</html>
