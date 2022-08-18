<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MyUserResource;
use App\Models\MyUsers;
use Illuminate\Http\Request;

class MyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = MyUsers::with('addresses', 'addresses.geo', 'company')->get();
        return MyUserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MyUsers  $myUsers
     * @return \Illuminate\Http\Response
     */
    public function show(MyUsers $myUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyUsers  $myUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(MyUsers $myUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyUsers  $myUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyUsers $myUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyUsers  $myUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyUsers $myUsers)
    {
        //
    }
}
