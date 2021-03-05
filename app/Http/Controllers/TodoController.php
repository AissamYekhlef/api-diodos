<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = Todo::create([
            'title' => $request->title,
            'completed' => false,
            'list_id' => $request->list,
        ]);

        return response()->json([
            'success' => 'true',
            'message' => 'Todo Created',
            'todo' => $todo,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $todo = Todo::find($request->todo);

        if($todo){
            $todo->title = $request->title  ? $request->title : $todo->title;
            // return response($request->completed);
            if($request->completed == "false"){
                $todo->completed = 0;
            }else{
                $todo->completed =  1;
            }
            $todo->save();
    
            return response()->json([
                'success' => 'true',
                'message' => 'Todo Updated',
                'todo' => $todo,
            ]);
        }else{
            return response()->json([
                'success' => 'false',
                'message' => 'Not Found Todo',
            ], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $todo = Todo::find($request->todo);

        if($todo){
            $todo->delete();
            return response()->json([
                'success' => 'true',
                'message' => 'Todo Deleted',
                'todo' => $todo,
            ]);
        }else{
            return response()->json([
                'success' => 'false',
                'message' => 'Not Found Todo',
            ], 404);
        }

        return $request->todo;
    }
}
