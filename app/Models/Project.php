<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Inserisco i dati da proteggere
    protected $fillable = [
        'project_name',
        'description',
        'start_date',
        'end_date',
        'status',
        'budget',
        'progress',
        'image',

        'type_id'
    ];


    // Inserisco la relazione con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Inserisco la relazione con Type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
