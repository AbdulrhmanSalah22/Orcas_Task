<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request){
       $users = User::paginate(10);

       return response()->json($users);
    }

    public function search(Request $request){
        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['firstName','lastName', 'email'])
            ->get();

        return response()->json($users);
    }
}
