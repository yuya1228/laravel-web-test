<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use App\Models\Tag;
use App\Http\Requests\TodosRequest;
use Illuminate\Support\Facades\Auth;
use Config\tag_list;
use Database\seeders\TodoTablesSeeder;

class TodoController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $user = Auth::user();
        $todos = Todo::paginate();
        $tags = Tag::all();
        $param = [ 'todos' => $todos, 'user' =>$user, 'tag'=>$tags ];
        return view( 'todo.index', $param, compact( 'tags' ) );
    }

    public function post( ClientRequest $request ) {
        return view( 'index', [ 'text' => '正しい入力です' ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create( TodosRequest $request ) {
        $form = $request->all();
        $user_id = Auth::user();
        $tags = Tag::all();
        $form[ 'user_id' ] = $user_id;
        Todo::create( $form );
        return redirect( '/home' );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $validated = $request->validate( [
            'title' => [ 'required', 'max:20' ],
        ] );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Todo $todo ) {
        $form = $request->all();
        unset( $form[ '_token' ] );
        Todo::where( 'id', $request->id )->update( $form );
        return redirect( '/home' );
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
        return redirect( '/home' );
    }

    public function postValidates( TodosRequest $request ) {
        return view( 'todo.index', [ 'msg'=>'OK' ] );
    }

    public function find( Request $request ) {
        $todo = Todo::query();
        $text_list = $request->input( 'text' );
        $tag = $request->input( 'tag_id' );
        if ( $todo !== null ) {
            $todo->where( 'text', 'like', '%$todo%' );
        };
        if ( $tag !== null ) {
            $todo->where( 'tag_id', $tag );
        };
        $todos = $todo->get();
        $user = Auth::user();
        return view( 'todo.search' )->with( [
            'todos'=>$todos,
            'user' =>$user,
        ] );
    }

    public function search( Request $request ) {
        $todos = Todo::where( 'text', $request->text )->
        where( 'tag_id', $request->tag_id )->get();
        $user = Auth::user();
        $tags = Tag::all();
        return view( 'todo.search' )->with( [
            'todos'=>$todos,
            'user' =>$user,
            'tags'=>$tags,
        ] );
    }

    public function delete( Request $request, $tag_id ) {
        $id = Todo::find( $request->id );
        $id->delete();
        return redirect( '/search' );
    }

    public function update_search( Request $request ) {
        $tags = Tag::all();
        return view( 'todo.search', compact( 'tags' ) );
    }
}
