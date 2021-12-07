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

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ClaimRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\UserUsers;
use App\Models\Item;
use App\Models\User;

class ClaimController extends ApiController
{
	/**
	* Display a listing of the resource.

	* @return Response
	*/
	public function index()
	{
		return response()->json(UserUsers::claimed_items(auth()->user()->id), 200);
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
		$item = Item::find($request->item_id);
		if($item->claimed) {
			return response()->json(["message" => "Item was claimed while you were on this page"], 409);
		} else {
			$item->claim($request->user());
			return response()->json(["message" => "Item Claimed"], 200);
		}
	}

	public function destroy(ClaimRequest $request)
	{
		$item = Item::find($request->item_id);
		$item->unclaim();
		return response()->json(["message" => "Item Unclaimed"]);
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
