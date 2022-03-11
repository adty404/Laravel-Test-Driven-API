<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = TodoList::all();
        return response($lists);
    }

    public function show(TodoList $todolist)
    {
        return response($todolist);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => ['required']]);
        return TodoList::create($request->all());
    }
}
