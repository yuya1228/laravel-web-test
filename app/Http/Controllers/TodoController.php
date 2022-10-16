<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $todos=Todo::all();
        return view('todos.index' , compact('todos'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view('todos.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $rules = [
            'todo_name' => 'required|max:20',
        ];
        $messages = [ 'required' => '入力必須です', 'max' => '20文字以下にしてください' ];
        Validator::make( $request->all(), $rules, $messages )->validate();

        $todo = new Todo;
        $todo->text = $request->input( 'todo_name' );
        $todo->save();
        return redirect( '/todos' );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        $todo = Todo::find($id);
        return view('todo.show',compact('todo'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        $todo = Todo::find($id);
        return view('todo.edit',compact('todo'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Todo $todo) {
        $todo->title = $request->title;
        $todo->content = $request->content;
        $todo->save();
        return redirect("/todos/{$todo->id}");
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        Todo::where('id', $id)->delete();
    }
}
