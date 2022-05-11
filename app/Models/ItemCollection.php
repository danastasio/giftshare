<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collection;
use App\Models\Item;

class ItemCollection extends Model
{
    use HasFactory;

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
