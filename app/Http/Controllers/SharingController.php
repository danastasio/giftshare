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
use App\Models\User_User;
use DB;

class SharingController extends Controller
{
	public function index() {
		return view('sharing');
	}
	public function create() {
		echo 'create';
	}
	public function store() {
		
		$request = request();
	        $usershare = new User_User;
		$sharee_id = DB::table('users')->where('email','=',$request->email)->value('id');
	        $usershare->owner_id = $request->user_id;
	        $usershare->sharee_id = $sharee_id;
	        $usershare->save();
	        return view('sharing');
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
	     $share = User_User::find($id);
	     $share->delete();
	     return view('sharing');
	}
}
