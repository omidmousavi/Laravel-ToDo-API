<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_can_list_todos()
    {
        // Arrange: Create some todo records
        Todo::factory()->count(3)->create();

        // Act: Send GET request to index route
        $response = $this->getJson(route('todo.index'));

        // Assert: Ensure response is correct
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_create_a_todo()
    {
        // Arrange: Prepare a new todo data
        $data = [
            'title' => $this->faker->sentence(),
            'status' => 'InProgress',
            'due_date' => Carbon::now()->toDateString(),
        ];

        // Act: Send POST request
        $response = $this->postJson(route('todo.store'), $data);

        // Assert: Ensure response is correct
        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('todos', $data);
    }

    /** @test */
    public function it_can_update_a_todo()
    {
        // Arrange: Create a todo
        $todo = Todo::factory()->create();
        $newData = ['title' => 'Updated Title'];

        // Act: Send PUT request
        $response = $this->putJson(route('todo.update', $todo), $newData);

        // Assert
        $response->assertStatus(200)
                 ->assertJsonFragment($newData);

        $this->assertDatabaseHas('todos', $newData);
    }

    /** @test */
    public function it_can_delete_a_todo()
    {
        // Arrange: Create a todo
        $todo = Todo::factory()->create();

        // Act: Send DELETE request
        $response = $this->deleteJson(route('todo.destroy', $todo));

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
