<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; line-height: 1.5; margin: 30px auto; max-width: 600px; padding: 0 20px; color: #1f2937; background-color: #f9fafb; }
        h1 { color: #111827; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; }
        .errors { background: #fee2e2; border: 1px solid #f87171; color: #991b1b; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; }
        .errors h3 { margin: 0 0 8px 0; font-size: 1rem; }
        .errors ul { margin: 0; padding-left: 20px; }
        form { background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; color: #374151; }
        input[type="text"], input[type="number"], select, textarea { width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #3b82f6; }
        .checkbox-label { display: flex; align-items: center; gap: 8px; font-weight: 500; cursor: pointer; }
        .checkbox-label input { width: 18px; height: 18px; cursor: pointer; }
        button[type="submit"] { background: #2563eb; color: #fff; border: none; padding: 10px 20px; border-radius: 6px; font-size: 1rem; font-weight: 600; cursor: pointer; }
        button[type="submit"]:hover { background: #1d4ed8; }
        .back-link { display: inline-block; margin-top: 16px; color: #4b5563; text-decoration: none; font-weight: 500; }
        .back-link:hover { color: #111827; text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Edit Course</h1>

    @if($errors->any())
        <div class="errors">
            <h3>Please fix the following errors:</h3>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/courses/{{ $course->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Course Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $course->name) }}"
                required
            >
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                rows="4"
            >{{ old('description', $course->description) }}</textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="duration">Duration (in weeks)</label>
            <input
                type="number"
                id="duration"
                name="duration"
                min="1"
                value="{{ old('duration', $course->duration) }}"
                required
            >
        </div>
        <br>
        <div class="form-group">
            <label for="fee">Course Fee ($)</label>
            <input
                type="number"
                id="fee"
                name="fee"
                step="0.01"
                min="0"
                value="{{ old('fee', $course->fee) }}"
                required
            >
        </div>
        <br>
        <div class="form-group">
            <label for="difficulty">Difficulty</label>
            <select id="difficulty" name="difficulty" required>
                <option value="">Select Difficulty</option>
                <option value="Easy" {{ old('difficulty', $course->difficulty) === 'Easy' ? 'selected' : '' }}>Easy</option>
                <option value="Medium" {{ old('difficulty', $course->difficulty) === 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Hard" {{ old('difficulty', $course->difficulty) === 'Hard' ? 'selected' : '' }}>Hard</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label class="checkbox-label">
                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $course->is_active) ? 'checked' : '' }}
                >
                Active Course
            </label>
        </div>
        <br>
        <button type="submit">Update Course</button>
    </form>
    <br>
    <a href="/courses" class="back-link">Back to Courses</a>
</body>
</html>
