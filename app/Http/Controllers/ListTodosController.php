<?php

namespace App\Http\Controllers;

use App\Models\ListTodos;
use App\Models\Project;
use Illuminate\Http\Request;

class ListTodosController extends Controller
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
        $newList = [
            'name' => $request->name,
            'description' => $request->description,
            'project_id' => $request->project
        ];

        $validated = $request->name != null && 
                     $request->description != null && 
                     $request->project != null;

        // $validator = $request->validated();
        // $validated = $request->validate([
        //     'name' => 'required|max:255',
        //     'description' => 'required|min:5',
        // ]);
        // return response()->json(
        //     $validated
        // ) ;
        $project = Project::find($request->project);

        if (! $project) {
            return response()->json([
                'message' => 'Project id does not exist',  
                'success' => 'false',     
                ],
                400);
        }
        
        if($validated && $project->user_id == auth()->user()->id){
            // $list = $newList;
            $list = ListTodos::create($newList);    
            $list->todos;
            return response()->json([
                'message' => 'list Created',  
                'success' => 'true',     
                'data' => [
                    'list' => $list
                    ]
                ],
                201); 
        }else {
            return response()->json([
                'message' => 'Request not valid',  
                'success' => 'false',     
                ],
                400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListTodos  $listTodos
     * @return \Illuminate\Http\Response
     */
    public function show(ListTodos $listTodos)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListTodos  $listTodos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updatedList = [
            'name' => $request->name,
            'description' => $request->description,
            'project_id' => $request->project
        ];

        $validated = ($request->name != null && $request->description != null) && $request->project != null;

        $list = ListTodos::findOrFail($request->list);
        // return $list;
        
        if($validated && $list->project_id == $request->project ){
            // $list = $newList;

            $list->name = $request->name;
            $list->description = $request->description;
            $list->save();
            
            $list->todos;
            return response()->json([
                'message' => 'list Updated',  
                'success' => 'true',     
                'data' => [
                    'list' => $list
                    ]
                ],
                200); 
        }else {
            return response()->json([
                'message' => 'Request not valid',  
                'success' => 'false',     
                ],
                400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListTodos  $listTodos
     * @return \Illuminate\Http\Response
     */
    public function destroy($project, $list)
    {
        // $listTodos->delete();
        $listTodos = ListTodos::findOrFail($list);
        // return $listTodos;
        if($listTodos->project->user_id == auth()->user()->id){
            $listTodos->delete();
            return response()->json([
                'message' => 'List Deleted',  
                'success' => 'true',
                'list' => $listTodos     
                ],
                200);
        }else {
            return response()->json([
                'message' => 'Unauthorized',  
                'success' => 'false',
                'list' => $listTodos     
                ],
                401);
        }

        
    }
}
