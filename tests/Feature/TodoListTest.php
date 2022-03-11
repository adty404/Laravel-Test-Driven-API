<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function fetch_all_todo_list()
    {
        // preperation / prepare
        TodoList::factory()->create(['name' => 'my list']); //Overiding the default factory

            // example of not overiding the default factory
            // TodoList::factory()->create();
            // $data = TodoList::first();

        // action / perform
        $response = $this->getJson(route('todo-list.index'));

        // assertion / predict
        $this->assertEquals(1,count($response->json()));
        $this->assertEquals('my list',$response->json()[0]['name']);

            // example of not overiding the default factory
            // $this->assertEquals($data,$response->json()[0]['name']);
    }

    /** @test */
    public function fetch_single_todo_list()
    {
        $list = TodoList::factory()->create();

        $response = $this->getJson(route('todo-list.show', $list->id))
                    ->assertOk()
                    ->json();

        $this->assertEquals($response['name'],  $list->name);
    }
}
