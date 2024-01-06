<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(Request $request)
    {
        $users = User::orderBy('id','asc');

        if($request->has('search')){
            $users = $users->where('name','LIKE','%'.$request->search.'%');
        }
        if($request->has('offset')){
            $users = $users->offset($request->offset);
        }
        if($request->has('limit')){
            $users = $users->limit($request->limit);
        }

        $users = $users->get();
        $totalCounts = User::count();
        return Response::success('User Fetched',['users' => $users,'total' => $totalCounts]);
    }
}
