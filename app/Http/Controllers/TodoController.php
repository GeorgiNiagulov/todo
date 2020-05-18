<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $request)
    {
        return Validator::make($request, [
          'title' => 'required',
          'created_at' => 'required'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Auth::user()->todo()->get();
        if (!$result->isEmpty()) {
          return view('todo.dashboard', ['todos'=>$result, 'name'=>Auth::user()->name]);
        } else {
          return view('todo.dashboard', ['todos'=>false, 'name'=>Auth::user()->name]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.addtodo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        if (Auth::user()->todo()->Create($request->all())) {
          return $this->index();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return view('todo.todo',['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('todo.edittodo', ['todo' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Todo  $todo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $this->validator($request->all())->validate();
        if ($todo->fill($request->all())->save()) {
          return $this->show($todo);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if ($todo->delete()) {
          return back();
        }
    }
}
