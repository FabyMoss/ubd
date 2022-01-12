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

            TD::make('address', 'Address'),
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
