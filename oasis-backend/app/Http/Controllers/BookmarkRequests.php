<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkRequests extends Controller
{
    public function requestTasks(Request $request){

        $request->validate([
            
        ]);

        return response()->json([
            'message' => 'Контролер живий'
        ], 200);
    }
}