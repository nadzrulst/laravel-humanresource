<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
</head>
<body>
    <h1>Employee Details</h1>
    <p><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</p>
    <p><strong>Department:</strong> {{ $employee->department->name }}</p>
    <p><strong>Position:</strong> {{ $employee->position->name }}</p>
    <a href="{{ route('employees.index') }}">Back to Employees List</a>
</body>
</html>
