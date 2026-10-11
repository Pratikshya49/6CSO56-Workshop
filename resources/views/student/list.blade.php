<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; line-height: 1.5; margin: 30px auto; max-width: 900px; padding: 0 20px; color: #1f2937; background-color: #f9fafb; }
        header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e5e7eb; padding-bottom: 15px; margin-bottom: 20px; }
        h1 { margin: 0; color: #111827; }
        .nav-links a { margin-left: 15px; color: #4b5563; text-decoration: none; font-weight: 500; }
        .nav-links a:hover { color: #111827; }
        .success-message { background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; }
        .btn-create { display: inline-block; background: #2563eb; color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; margin-bottom: 16px; }
        .btn-create:hover { background: #1d4ed8; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        th, td { padding: 12px 16px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f3f4f6; font-weight: 600; color: #374151; }
        tr:hover { background-color: #f9fafb; }
        .action-link { margin-right: 8px; color: #2563eb; text-decoration: none; font-weight: 500; }
        .action-link:hover { text-decoration: underline; }
        .btn-delete { background: #ef4444; color: #fff; border: none; padding: 4px 10px; border-radius: 4px; cursor: pointer; font-size: 0.875rem; }
        .btn-delete:hover { background: #dc2626; }
    </style>
</head>
<body>
    <header>
        <h1>Students</h1>
        <div class="nav-links">
            <a href="/students">Students</a>
            <a href="/courses">Courses</a>
        </div>
    </header>

    @if(session('success'))
        <div class="success-message">
            <p style="margin: 0;">{{ session('success') }}</p>
        </div>
    @endif

    <a href="/students/create" class="btn-create">Create Student</a>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>
                        <a href="/students/{{ $student->id }}" class="action-link">View</a>
                        <a href="/students/{{ $student->id }}/edit" class="action-link">Edit</a>
                        <form
                            action="/students/{{ $student->id }}"
                            method="POST"
                            style="display:inline"
                            onsubmit="return confirm('Are you sure you want to delete this student?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #6b7280; padding: 24px;">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
