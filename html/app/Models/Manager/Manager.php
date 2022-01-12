<?php

namespace App\Models\Manager;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manager extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'name',
        'age'
    ];
}
