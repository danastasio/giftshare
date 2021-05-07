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
use App\Models\UserUsers;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ItemRequest;
use DB;

class ItemController extends Controller {
	/**
		* Display a listing of the resource.
		*
		* @return Response
		*/
	public function index() {
		$myUsers = UserUsers::where('sharee_id', auth()->user()->id)->with('owner')->get();


		$access_users = array();
		foreach ($myUsers as $share) {
			array_push($access_users, $share['owner']);
		}

		$shared_items_by_user = array();
		foreach ($access_users as $user) {
			$item = User::where('id',$user['id'])->with('items')->with('items')->get();
			array_push($shared_items_by_user, $item);
		}
		//return $shared_items_by_user;
		return view('dashboard')->with('shared_items', $shared_items_by_user);
	}

	/**
		* Show the form for creating a new resource.
		*
		* @return Response
		*/
	public function create() {
		//
	}

	/**
		* Store a newly created resource in storage.
		*
		* @return Response
		*/
	public function store() {
		$request = request();

		// validate input
		$validated = $request->validate([
			'name' => 'bail|required|max:255',
			'url' => 'nullable|url'
		]);

		$item = new Item;
		$item->name = $request->name;
		@$item->description = $request->description;
		@$item->url = $request->url;
		$item->owner_id = auth()->user()->id;
		$item->save();

		return redirect('list')->withSuccess('Item added');
	}
	public function destroy(ItemRequest $request) {
		$request = $request->validated();
		if (!Gate::allows('delete', Item::find($request['id']))) {
			return abort(403, 'Unauthorized');
		}
		$item = Item::find($request['id']);
		$item->delete();
		return redirect('list')->withInfo('Item deleted');
	}
	/**
		* Display the specified resource.
		*
		* @param  int  $id
		* @return Response
		*/
	public function show($id) {
		//
	}

	/**
		* Show the form for editing the specified resource.
		*
		* @param  int  $id
		* @return Response
		*/
	public function edit($id) {
		//
	}

	/**
		* Update the specified resource in storage.
		*
		* @param  int  $id
		* @return Response
		*/
	public function update(ItemRequest $request) {
		$request = $request->validated();
		if (!Gate::allows('update', Item::find($request['id']))) {
			return abort(403, 'Unauthorized');
		};
		$item_find = Item::where('id',$request['id'])->value('id');
		$item = Item::find($item_find);
		$item->name = $request['name'];
		@$item->description = $request['description'];
		@$item->url = $request['url'];
		$item->save();
		return back();
	}
	public function list() {
		$own_items = Item::where('owner_id', auth()->user()->id)->get();
		return view('list')->with('own_items', $own_items);
	}
}
