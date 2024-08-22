<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'case_number',
        'date',
        'pais',
        'CC',
        'part_number',
        'description',
        'quantity',
        'provider',
        'unitary_price',
        'total_price',
        'priority',
        'OC',
        'ETA',
        'client_id',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
