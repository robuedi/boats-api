<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{

    protected $fillable = ['email', 'boat_id', 'price', 'currency', 'status', 'intent_id'];

    public function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class, 'id');
    }
}
