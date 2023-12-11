<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = ['name','event_id','user_id'];

    public function event(): HasOne
    {
        return $this->hasOne(Event::class);
    }

}
