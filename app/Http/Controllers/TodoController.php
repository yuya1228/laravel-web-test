<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TodosRequest;

class TodoController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $todos = Todo::all();
        return view( 'todos.index', compact( 'todos' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create( TodosRequest $request ) {
        $form = $request->all('id');
        Todo::create($form);
        return redirect('/');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        $todo = Todo::find( $id );
        return view( 'todos.show', compact( 'todos' ) );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( Request $request ) {
        $todo = Todo::find($request->$id );
        return view( 'edit', ['form' => $todo] );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Todo $todo ) {
        $form = $request->all('id','text');
        unset($form['_token']);
        Todo::where('id',$request->id)->update($form);
        return redirect('/');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( Request $request, $id ) {
        $id = Todo::find( $request->id );
        $id->delete();
        return redirect( route( 'todo.index' ) );
    }
}
