<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; line-height: 1.6; margin: 30px auto; max-width: 650px; padding: 0 20px; color: #1f2937; background-color: #f9fafb; }
        .card { background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; color: #111827; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; }
        p { margin: 12px 0; font-size: 1rem; }
        strong { color: #374151; min-width: 140px; display: inline-block; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 9999px; font-size: 0.85rem; font-weight: 600; }
        .badge-easy { background: #dcfce7; color: #15803d; }
        .badge-medium { background: #fef9c3; color: #a16207; }
        .badge-hard { background: #fee2e2; color: #b91c1c; }
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
        <h1>Course Details</h1>

        @if(session('success'))
            <div class="success-message">
                <p style="margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <p>
            <strong>ID:</strong>
            {{ $course->id }}
        </p>
        <p>
            <strong>Name:</strong>
            {{ $course->name }}
        </p>
        <p>
            <strong>Description:</strong>
            {{ $course->description ?? 'No description provided.' }}
        </p>
        <p>
            <strong>Duration:</strong>
            {{ $course->duration }} weeks
        </p>
        <p>
            <strong>Fee:</strong>
            ${{ number_format($course->fee, 2) }}
        </p>
        <p>
            <strong>Difficulty:</strong>
            @if($course->difficulty === 'Easy')
                <span class="badge badge-easy">Easy</span>
            @elseif($course->difficulty === 'Medium')
                <span class="badge badge-medium">Medium</span>
            @else
                <span class="badge badge-hard">Hard</span>
            @endif
        </p>
        <p>
            <strong>Status:</strong>
            <span style="font-weight: 600; color: {{ $course->is_active ? '#16a34a' : '#dc2626' }};">
                {{ $course->is_active ? 'Active' : 'Inactive' }}
            </span>
        </p>
        <p>
            <strong>Created At:</strong>
            {{ $course->created_at }}
        </p>
        <p>
            <strong>Updated At:</strong>
            {{ $course->updated_at }}
        </p>

        <div class="actions">
            <a href="/courses/{{ $course->id }}/edit" class="btn-edit">Edit Course</a>
            <a href="/courses" class="back-link">Back to Courses</a>
        </div>
    </div>
</body>
</html>
