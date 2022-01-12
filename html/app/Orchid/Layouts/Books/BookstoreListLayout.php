<?php

namespace App\Orchid\Layouts\Books;

use Orchid\Screen\TD;
use App\Models\Books\Bookstore;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class BookstoreListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'bookstores';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->render(function (Bookstore $bookstore) {
                    return Link::make($bookstore->name)
                        ->route('platform.bookstore.edit', $bookstore);
                }),
            TD::make('manager')->render(function(Bookstore $bookstore){
                return $bookstore->manager->name ?? '';
            }),
            TD::make('city')->render(function(Bookstore $bookstore){
                return $bookstore->city->name ?? '';
            }),
            TD::make('address', 'Address'),
            TD::make('updated')->render(function(Bookstore $bookstore){
                return $bookstore->updated_at->diffForHumans() ?? '';
            }),
            TD::make('created')->render(function(Bookstore $bookstore){
                return $bookstore->created_at->toDateTimeString() ?? '';
            }),
            // TD::make('created_at', 'Created'),
            // TD::make('updated_at', 'Last edit'),
        ];
    }
}
