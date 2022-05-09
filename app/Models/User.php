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

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserItems;
use App\Models\Item;
use App\Models\Collection;
use App\Models\UserCollection;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'email_verified_at',
        'is_admin',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'		=> 'datetime',
        'udpated_at'		=> 'datetime',
        'deleted_at'		=> 'datetime',
        'is_admin'			=> 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    protected function authenticated(Request $request)
    {
        $variable = 7;
        return redirect('/?variable='.$variable);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function claims()
    {
        return $this->belongsToMany(Item::class, 'user_item_claims', 'claimant_id');
    }

    public function remote_claims()
    {
    	return $this->belongsToMany(Item::class, 'user_item_claims', 'owner_id')
    		->wherePivot('claimant_id', auth()->user()->id);
    }

	public function collections()
	{
		return $this->belongstomany(collection::class, 'collection_user', 'owner_id')
			->wherePivot('access_type', '2')
			->withPivot('access_type');
	}

	public function visible_collections()
	{
		return $this->belongstomany(collection::class, 'collection_user', 'owner_id')
			->wherePivot('sharee_id', auth()->user()->id)
			->withPivot('access_type');
	}


	public function shared_collections()
	{
		return $this->belongsToMany(Collection::class, 'collection_user', 'sharee_id')
			->wherePivot('access_type', '1');
	}

	public function shares()
	{
		return $this->belongsToMany(User::class, 'user_user', 'owner_id', 'sharee_id')
			->wherePivot('owner_id', auth()->user()->id);
	}

	public function shared_with_user()
	{

		return $this->belongsToMany(User::class, 'user_user', 'sharee_id', 'owner_id')
			->wherePivot('sharee_id', auth()->user()->id);
	}
}
