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
use App\Models\Item;
use App\Models\UserItems;
use DB;

class ItemController extends Controller {
	/**
		* Display a listing of the resource.
		*
		* @return Response
		*/
	public function index() {
		return view('dashboard');
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
		$item->save();

		$useritem = new UserItems;
		$useritem->user_id = $request->user_id;
		$useritem->item_id = $item->id;
		$useritem->save();
		return redirect('list')->withSuccess('Item added');
	}
	public function destroy($id) {
		$item = Item::find($id);
		$user_link_find = DB::table('user_items')->where('item_id','=',$id)->value('id');
		$user_link = UserItems::find($user_link_find);
		$item->delete();
		$user_link->delete();
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
	public function update(Request $request, $id) {
	 	$request = request();

		$item_find = DB::table('items')->where('id','=',$id)->value('id');
		$item = Item::find($item_find);
		$item->name = $request->name;
		@$item->description = $request->description;
		@$item->url = $request->url;
		$item->save();	   
		$request->is_update = False;
		return redirect('list')->withSuccess('Item updated');
	}
	public function claim() {
		$request = request();
		$item_id = $request->item;
		$user_id = $request->user;

		$user_item_find = DB::table('user_items')->where('item_id','=',$item_id)->value('id');
		$user_item = UserItems::find($user_item_find);
		if($user_item->claimed == 1) {
			return redirect('/')->withError("Item was claimed while you were on this page");
		} else {
			$user_item->claimed = 1;
			$user_item->claimant_id = $user_id;
			$user_item->save();
			return redirect('/');
		}
	}
	public function unclaim() {
		$request = request();
		$item_id = $request->item;
		$user_id = $request->user;

		$user_item_find = DB::table('user_items')->where('item_id','=',$item_id)->value('id');
		$user_item = UserItems::find($user_item_find);
		$user_item->claimed = 0;
		$user_item->claimant_id = NULL;
		$user_item->save();
		return redirect('/');
	}
	public function list() {
		return view('list');
	}
	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
}
