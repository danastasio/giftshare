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
use DB;

class ShareController extends Controller
{
	public function index() {
		return view('sharing');
	}
	public function create() {
		echo 'create';
	}
	public function store() {
		
		// validate data
		
		$request = request();
		$validated = $request->validate(['email' => 'bail|required|max:255']);
	        $usershare = new UserUsers;
		$sharee_id = DB::table('users')->where('email','=',$request->email)->value('id');
		
		// prevent users from sharing with themselves
		if ($request->user_id == $sharee_id) {
			return redirect('share')->withInfo('You cannot add yourself. Nice try though 😉');
			//return redirect('sharing');
		}

		// check to see if share exists
		$exists = DB::table('user_users')
			->where('owner_id','=',$request->user_id)
			->where('sharee_id','=',$sharee_id)
			->get();
		if($exists->count() > 0) {
			return redirect('share')->withInfo('Share already exists between you');
		} 

		// check to see if user exists
		$exists = User::find($sharee_id);
		if(!$exists) {
			return redirect('share')->withError('User does not exist');
		} else {
		        $usershare->owner_id = $request->user_id;
		        $usershare->sharee_id = $sharee_id;
		        $usershare->save();
			return redirect('share')->withSuccess('List shared with user');
		}
	}
	public function show($id) {
		echo 'show';
	}
	public function edit($id) {
		echo 'edit';
	}
	public function update(Request $request, $id) {
		echo 'update';
	}
	public function destroy($id) {
	     $share = UserUsers::find($id);
	     $share->delete();
	     return redirect('share')->withInfo('List revoked from user');
	}
}
