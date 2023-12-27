<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'user_id', 'attachment', 'status', 'from_date', 'to_date', 'from_time', 'to_time'];

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}
