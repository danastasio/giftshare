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
use App\Models\User;

class AdminPanel extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		$users = User::all();
		return view('admin-panel')->with('users', $users);
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

	public function store()
	{
	}

	public function destroy()
	{
	}

	public function show()
	{
	}

	public function edit()
	{
	}

	public function update()
	{
	}
}
