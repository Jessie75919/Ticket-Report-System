<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'PENDING';
    const STATUS_PROCESSING = 'PROCESSING';
    const STATUS_RESOLVED = 'RESOLVED';

    protected $guarded = [];

    public function createUser()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function resolveUser()
    {
        return $this->belongsTo(User::class, 'resolved_user_id');
    }


}
