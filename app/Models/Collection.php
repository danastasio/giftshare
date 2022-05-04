<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserCollection;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function user_collections()
    {
		return $this->belongsTo(UserCollection::class);
    }
}
