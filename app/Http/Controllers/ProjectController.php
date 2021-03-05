<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->userOrFail();
        $projects = Project::where('user_id', '=', $user->id )->with('lists')->get();
        return response()->json([
            "projects" => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);
        $project->lists;
        return response()->json([
            'message' => 'project Created',  
            'success' => 'true',     
            'data' => [
                'project' => $project
            ]
           
            ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $user = auth()->userOrFail(); 
        $todosCount = 0;
        foreach ($project->lists as $list) {
            $list->todos;
            $todosCount += $list->todos->count();
        }   
        $project->todos_count = $todosCount;
        if($user->id == $project->user_id){
            return response()->json([
                'project' => $project,
            ]);
        }else {
            return response()->json([
                'error' => 'Unauthorized',     
            ], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $user = auth()->userOrFail(); 
        if($user->id == $project->user_id){
            
            $request->name === null ? :$project->name = $request->name;
            $request->description === null ? :$project->description = $request->description;
            $project->save();

            return response()->json([
                'message' => 'project Updated',   
                'success' => 'true',     
                'data' => [
                    'project' => $project
                ]    
            ]);
        }else {
            return response()->json([
                'error' => 'Unauthorized',     
            ], 401);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // return response()->json($project);
        $user = auth()->userOrFail(); 

        if($user->id == $project->user_id){
            if($project->lists->count() == 0){
                $project->delete();
                return response()->json([
                    'message' => 'project Deleted',     
                    'success' => 'true',     
                ]);
            }else{
                return response()->json([
                    'error' => 'project has lists',     
                ],401);
            }
        }else {
            return response()->json([
                'error' => 'Unauthorized',     
            ], 401);
        }
    } 
}
