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

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserUsers extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = ['owner_id', 'sharee_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function sharee()
    {
        return $this->belongsTo(User::class, 'sharee_id');
    }

	public function items()
	{
		return $this->hasManyThrough(Item::class, User::class, 'id', 'owner_id', 'owner_id', 'id');
	}

	public static function claimed_items(int $user_id)
	{
		return UserUsers::where('sharee_id', $user_id)->with([
			'owner',
			'items' => function ($query) use (&$user_id) {
				$query->where('claimant_id', $user_id)
				->where('claimed', true);
			},
		])->get();
	}

	public static function shared_items(int $user_id)
	{
		return UserUsers::where('sharee_id', $user_id)->with([
			'owner',
			'items' => function ($query) use (&$user_id) {
				$query->where('claimed', false)
					  ->orWhere('claimant_id', $user_id);
			}
		])->get();
	}

	public static function my_shares(int $user_id)
	{
		return UserUsers::where('owner_id', $user_id)->with('sharee')->get();
	}

	public static function shared_with_me(int $user_id)
	{
		return UserUsers::where('sharee_id', $user_id)->with('owner')->get();
	}
}
