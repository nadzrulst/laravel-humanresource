<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Notification</title>
</head>
<body>
    <h1>Create Notification</h1>
    <form action="{{ route('notifications.store') }}" method="POST">
        @csrf
        <label for="user_id">User:</label>
        <select name="user_id" id="user_id" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
            @endforeach
        </select>
        <br>

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br>

        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea>
        <br>

        <label for="type">Type:</label>
        <input type="text" name="type" id="type" required>
        <br>

        <label for="is_read">Is Read:</label>
        <input type="checkbox" name="is_read" id="is_read">
        <br>

        <button type="submit">Create Notification</button>
    </form>
    <a href="{{ route('notifications.index') }}">Back to Notifications</a>
</body>
</html>
