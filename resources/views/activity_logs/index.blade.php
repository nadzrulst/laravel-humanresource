<!-- resources/views/activity_logs/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="body index">
    @extends('bar')

    @section('page-title')
        <h1>Activity Logs</h1>
    @endsection

    @section('content')
    <div class="content-header">
        <a href="{{ route('activity_logs.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Create New Activity Log
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Activity Type</th>
                <th>Table Name</th>
                <th>Record ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activityLogs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->user->first_name }} {{ $log->user->last_name }}</td>
                <td>{{ $log->activity_type }}</td>
                <td>{{ $log->table_name }}</td>
                <td>{{ $log->record_id }}</td>
                <td>
                    <a href="{{ route('activity_logs.show', $log->id) }}" class="btn btn-sm btn-info">View</a> |
                    <a href="{{ route('activity_logs.edit', $log->id) }}" class="btn btn-sm btn-primary">Edit</a> |
                    <form action="{{ route('activity_logs.destroy', $log->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
</body>
</html>
