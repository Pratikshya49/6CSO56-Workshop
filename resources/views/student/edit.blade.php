<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; line-height: 1.5; margin: 30px auto; max-width: 600px; padding: 0 20px; color: #1f2937; background-color: #f9fafb; }
        h1 { color: #111827; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; }
        .errors { background: #fee2e2; border: 1px solid #f87171; color: #991b1b; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; }
        .errors h3 { margin: 0 0 8px 0; font-size: 1rem; }
        .errors ul { margin: 0; padding-left: 20px; }
        form { background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; color: #374151; }
        input[type="text"], input[type="email"], input[type="date"], textarea { width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; }
        input:focus, textarea:focus { outline: none; border-color: #3b82f6; }
        button[type="submit"] { background: #2563eb; color: #fff; border: none; padding: 10px 20px; border-radius: 6px; font-size: 1rem; font-weight: 600; cursor: pointer; }
        button[type="submit"]:hover { background: #1d4ed8; }
        .back-link { display: inline-block; margin-top: 16px; color: #4b5563; text-decoration: none; font-weight: 500; }
        .back-link:hover { color: #111827; text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Edit Student</h1>

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

    <form action="/students/{{ $student->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $student->name) }}"
                required
            >
        </div>
        <br>
        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $student->email) }}"
                required
            >
        </div>
        <br>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone', $student->phone) }}"
                required
            >
        </div>
        <br>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea
                id="address"
                name="address"
                rows="3"
            >{{ old('address', $student->address) }}</textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input
                type="date"
                id="date_of_birth"
                name="date_of_birth"
                value="{{ old('date_of_birth', $student->date_of_birth) }}"
            >
        </div>
        <br>
        <button type="submit">Update Student</button>
    </form>
    <br>
    <a href="/students" class="back-link">Back to Students</a>
</body>
</html>
