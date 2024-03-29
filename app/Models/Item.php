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
use App\Models\User;

class Item extends Model
{
	use SoftDeletes;

    protected $fillable = ['name','description','url','image_url'];
    protected $dates = ['deleted_at'];
    protected $casts = ['claimed' => 'boolean'];

    public function items()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

	public static function own_items(int $user_id)
	{
		return Item::where('owner_id', $user_id)->get();
	}

	public static function low_availability_warning(int $user_id): bool
	{
		$my_total_items = Item::where('owner_id', $user_id)->count();
		$my_claimed_items = Item::where('owner_id', $user_id)->where('claimed', true)->count();
		if ($my_total_items === 0) {
			return false;
		} else {
			$claimed_percentage = $my_claimed_items / $my_total_items;
			return $claimed_percentage >= 0.8;
		}
	}
}
