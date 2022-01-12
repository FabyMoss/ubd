<?php

namespace App\Models\Books;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'title',
        'author',
        'year',
    ];
}
