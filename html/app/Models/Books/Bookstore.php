<?php

namespace App\Models\Books;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookstore extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'name',
        'address',
        'manager_id',
    ];
}
