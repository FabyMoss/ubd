<?php

namespace App\Models\Stock;

use App\Models\Books\Book;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    use AsSource;

    public function bookstore()
    {
        return $this->belongsTo(Bookstore::class, 'bookstore_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
