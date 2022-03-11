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
    public function fetch_todo_list()
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
}
