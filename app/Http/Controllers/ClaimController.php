<?php

/*
    Copyright (C) 2020  David D. Anastasio

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published
    by the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ClaimRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Item;
use App\Models\User;

class ClaimController extends Controller
{
    /**
    * Display a listing of the resource.

    * @return Response
    */
    public function index()
    {
        $claims = Item::withTrashed()
        	->where('items.claimant_id', auth()->user()->id)
	        ->join('users', 'users.id', 'items.owner_id')
	        ->orderBy('items.owner_id')
        	->select(['items.id','items.name','items.description','items.url','users.name AS user_name','items.claimed','items.claimant_id', 'users.profile_photo_path', 'items.deleted_at'])
        	->get();
        return view('claims')->with('claims', $claims);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store(ClaimRequest $request)
    {
        // Moved to livewire component
        /*$user_item = Item::find($request['item']);
        dd($user_item);
        if($user_item[0]['claimed'] == 1) {
            return redirect('/')->withError("Item was claimed while you were on this page");
        } else {
            $user_item[0]['claimed'] = 1;
            $user_item[0]['claimant_id'] = auth()->user()->id;
            $user_item[0]->save();
            return back();
        } */
    }
    public function destroy(ClaimRequest $request)
    {
        $request = $request->validated();

        $user_item = Item::where('id', $request['item'])->get();
        $user_item[0]['claimed'] = 0;
        $user_item[0]['claimant_id'] = null;
        $user_item[0]->save();
        return back();
    }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request, $id)
    {
        //
    }
}
