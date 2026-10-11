<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentCourseCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_student_list(): void
    {
        $response = $this->get('/students');
        $response->assertStatus(200);
        $response->assertSee('Students');
        $response->assertSee('No students found.');
    }

    public function test_can_create_student(): void
    {
        $response = $this->post('/students', [
            'name'          => 'John Doe',
            'email'         => 'john@example.com',
            'phone'         => '1234567890',
            'address'       => '123 Elm Street',
            'date_of_birth' => '2000-01-01',
        ]);

        $response->assertRedirect('/students');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('students', [
            'email' => 'john@example.com',
            'name'  => 'John Doe',
        ]);
    }

    public function test_student_validation(): void
    {
        $response = $this->post('/students', []);
        $response->assertSessionHasErrors(['name', 'email', 'phone']);
    }

    public function test_can_view_student_detail(): void
    {
        $student = Student::create([
            'name'          => 'Jane Doe',
            'email'         => 'jane@example.com',
            'phone'         => '9876543210',
            'address'       => '456 Oak Avenue',
            'date_of_birth' => '1998-05-15',
        ]);

        $response = $this->get("/students/{$student->id}");
        $response->assertStatus(200);
        $response->assertSee('Jane Doe');
        $response->assertSee('jane@example.com');
    }

    public function test_can_update_student(): void
    {
        $student = Student::create([
            'name'          => 'Alice Bob',
            'email'         => 'alice@example.com',
            'phone'         => '1112223333',
            'address'       => '789 Pine Rd',
            'date_of_birth' => '2001-09-09',
        ]);

        $response = $this->put("/students/{$student->id}", [
            'name'          => 'Alice Smith',
            'email'         => 'alice@example.com',
            'phone'         => '1112223333',
            'address'       => 'Updated Address',
            'date_of_birth' => '2001-09-09',
        ]);

        $response->assertRedirect("/students/{$student->id}");
        $this->assertDatabaseHas('students', [
            'id'      => $student->id,
            'name'    => 'Alice Smith',
            'address' => 'Updated Address',
        ]);
    }

    public function test_can_delete_student(): void
    {
        $student = Student::create([
            'name'          => 'To Delete',
            'email'         => 'delete@example.com',
            'phone'         => '5555555555',
        ]);

        $response = $this->delete("/students/{$student->id}");
        $response->assertRedirect('/students');
        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);
    }

    public function test_can_view_course_list(): void
    {
        $response = $this->get('/courses');
        $response->assertStatus(200);
        $response->assertSee('Courses');
        $response->assertSee('No courses found.');
    }

    public function test_can_create_course(): void
    {
        $response = $this->post('/courses', [
            'name'        => 'Web Development',
            'description' => 'Full stack web development course',
            'duration'    => 12,
            'fee'         => 499.99,
            'difficulty'  => 'Medium',
            'is_active'   => '1',
        ]);

        $response->assertRedirect('/courses');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('courses', [
            'name'       => 'Web Development',
            'difficulty' => 'Medium',
            'duration'   => 12,
        ]);
    }

    public function test_course_validation(): void
    {
        $response = $this->post('/courses', []);
        $response->assertSessionHasErrors(['name', 'duration', 'fee', 'difficulty']);
    }

    public function test_can_view_course_detail(): void
    {
        $course = Course::create([
            'name'        => 'Data Science',
            'description' => 'Learn Python and ML',
            'duration'    => 16,
            'fee'         => 799.00,
            'difficulty'  => 'Hard',
            'is_active'   => true,
        ]);

        $response = $this->get("/courses/{$course->id}");
        $response->assertStatus(200);
        $response->assertSee('Data Science');
        $response->assertSee('Hard');
    }

    public function test_can_update_course(): void
    {
        $course = Course::create([
            'name'        => 'UI/UX Design',
            'description' => 'Figma basics',
            'duration'    => 6,
            'fee'         => 299.00,
            'difficulty'  => 'Easy',
            'is_active'   => true,
        ]);

        $response = $this->put("/courses/{$course->id}", [
            'name'        => 'Advanced UI/UX Design',
            'description' => 'Figma and prototyping',
            'duration'    => 8,
            'fee'         => 349.00,
            'difficulty'  => 'Medium',
            'is_active'   => '1',
        ]);

        $response->assertRedirect("/courses/{$course->id}");
        $this->assertDatabaseHas('courses', [
            'id'         => $course->id,
            'name'       => 'Advanced UI/UX Design',
            'difficulty' => 'Medium',
        ]);
    }

    public function test_can_delete_course(): void
    {
        $course = Course::create([
            'name'        => 'To Delete Course',
            'description' => 'Test',
            'duration'    => 4,
            'fee'         => 100.00,
            'difficulty'  => 'Easy',
            'is_active'   => false,
        ]);

        $response = $this->delete("/courses/{$course->id}");
        $response->assertRedirect('/courses');
        $this->assertDatabaseMissing('courses', [
            'id' => $course->id,
        ]);
    }
}
