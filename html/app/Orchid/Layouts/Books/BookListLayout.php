<?php

namespace App\Orchid\Layouts\Books;

use Orchid\Screen\TD;
use App\Models\Books\Book;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class BookListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'books';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('title', 'Title')
                ->render(function (Book $book) {
                    return Link::make($book->title)
                        ->route('platform.book.edit', $book);
                }),

            TD::make('author', 'Author'),
            TD::make('year', 'Release year'),
            TD::make('updated')->render(function(Book $book){
                return $book->updated_at->diffForHumans() ?? '';
            }),
            TD::make('created')->render(function(Book $book){
                return $book->created_at->toDateTimeString() ?? '';
            }),
        ];
    }
}
