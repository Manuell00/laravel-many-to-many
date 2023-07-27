<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Inserisco i dati da proteggere
    protected $fillable = [
        'type_name',
        'description',
    ];

    // Inserisco la relazione con project
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
