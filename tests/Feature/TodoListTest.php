<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    private $list;

    public function setUp():void
    {
        parent::setUp();
        $this->list = $this->createTodoList();
    }

    /** @test */
    public function fetch_all_todo_list()
    {
        $response = $this->getJson(route('todo-list.index'));

        $this->assertEquals(1, count($response->json()));
        $this->assertEquals($this->list->name, $response->json()[0]['name']);
    }

    /** @test */
    public function fetch_single_todo_list()
    {
        $response = $this->getJson(route('todo-list.show', $this->list->id))
                    ->assertOk()
                    ->json();

        $this->assertEquals($response['name'], $this->list->name);
    }

    /** @test */
    public function store_new_todo_list()
    {
        $list = TodoList::factory()->make();
        $response = $this->postJson(route('todo-list.store'),['name' => $list->name])
            ->assertCreated()
            ->json();

        $this->assertEquals($list->name,$response['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $list->name]);
    }

    /** @test */
    public function while_storing_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();

        $this->postJson(route('todo-list.store'))
                ->assertUnprocessable()
                ->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function delete_todo_list()
    {
        $this->deleteJson(route('todo-list.destroy',$this->list->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists',['name' => $this->list->name]);
    }

    /** @test */
    public function update_todo_list()
    {
        $this->patchJson(route('todo-list.update',$this->list->id),['name' => 'updated name'])
        ->assertOk();

        $this->assertDatabaseHas('todo_lists',['id' => $this->list->id, 'name' => 'updated name']);
    }

    /** @test */
    public function while_updating_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();

        $this->patchJson(route('todo-list.update', $this->list->id))
                ->assertUnprocessable()
                ->assertJsonValidationErrors(['name']);
    }
}
