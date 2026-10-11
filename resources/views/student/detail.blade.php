<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; line-height: 1.6; margin: 30px auto; max-width: 600px; padding: 0 20px; color: #1f2937; background-color: #f9fafb; }
        .card { background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; color: #111827; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; }
        p { margin: 12px 0; font-size: 1rem; }
        strong { color: #374151; min-width: 120px; display: inline-block; }
        .actions { margin-top: 24px; display: flex; gap: 12px; align-items: center; }
        .btn-edit { background: #2563eb; color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; }
        .btn-edit:hover { background: #1d4ed8; }
        .back-link { color: #4b5563; text-decoration: none; font-weight: 500; }
        .back-link:hover { color: #111827; text-decoration: underline; }
        .success-message { background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Student Details</h1>

        @if(session('success'))
            <div class="success-message">
                <p style="margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <p>
            <strong>ID:</strong>
            {{ $student->id }}
        </p>
        <p>
            <strong>Name:</strong>
            {{ $student->name }}
        </p>
        <p>
            <strong>Email:</strong>
            {{ $student->email }}
        </p>
        <p>
            <strong>Phone:</strong>
            {{ $student->phone }}
        </p>
        <p>
            <strong>Address:</strong>
            {{ $student->address ?? 'N/A' }}
        </p>
        <p>
            <strong>Date of Birth:</strong>
            {{ $student->date_of_birth ?? 'N/A' }}
        </p>

        <div class="actions">
            <a href="/students/{{ $student->id }}/edit" class="btn-edit">Edit Student</a>
            <a href="/students" class="back-link">Back to Students</a>
        </div>
    </div>
</body>
</html>
