<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_courses(): void
    {
        $response = $this->get('/api/courses');

        $response->assertStatus(200);
    }

    public function test_can_get_featured_courses(): void
    {
        $response = $this->get('/api/courses/featured');

        $response->assertStatus(200);
    }
}
