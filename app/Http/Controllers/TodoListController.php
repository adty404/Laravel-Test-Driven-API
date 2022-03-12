<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function destroy(TodoList $todolist)
    {
        $todolist->delete();
        return response('',Response::HTTP_NO_CONTENT);
    }

    public function update(Request $request, TodoList $todolist)
    {
        $request->validate(['name' => ['required']]);

        $todolist->update($request->all());
        return response($todolist);
    }
}
