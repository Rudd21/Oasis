<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function createProject(Request $request){
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'=>'required|string'
        ]);

        $user = $request->user();

        if(!$user){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $project = Project::create([
            'title' => $validate['title'],
            'description' => $validate['description'],
            'status' => $validate['status'],
            'idOwner' => $user->id,
            'idManager' => $user->id,
            'members' => []
        ]);

        return response()->json([
            'message' => 'Project created successfully!',
            'project' => $project
        ], 201);
    }
}
