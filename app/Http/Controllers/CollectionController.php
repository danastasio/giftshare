<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CollectionRequest;
use App\Models\User;
use App\Models\Collection;
use App\Models\UserCollection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // only showing items in collection. needs to show all
        return view('collections.index')->with([
            'shares' => auth()->user()->shares()->get(),
            'collections' => auth()->user()->collections()->with('items')->get(),
            'shared_with_me' => auth()->user()->shared_with_user()->get(),
            'items'			 => auth()->user()->items()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionRequest $request, User $user)
    {
        $collection = new Collection($request->validated());
        if (strtolower($collection->name) === "default collection") {
            return redirect('collection')->with(['error' => "'Default Collection' is a reserved name. Please choose a different name"]);
        }
        $collection->status = true;
        $collection->save();
        auth()->user()->collections()->attach($collection, ['access_type' => 2]);
        return redirect('collection')->with(['success' => 'Collection Added']);
        /* return view('collections.index')->with([
        	'success' => 'Collection added successfully',
        	'collections' => auth()->user()->collections()->get(),
        	'shared_with_me' => auth()->user()->shared_with_user()->get(),
        ]);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectionRequest $request)
    {
        auth()->user()->collections()->where('collections.id', $request->id)->delete();
        return redirect('collection')->with(['success' => 'Collection was deleted']);
    }
}
