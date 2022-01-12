<?php

namespace App\Orchid\Screens\Book;

use Orchid\Screen\Screen;
use App\Models\Books\Book;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Books\BookListLayout;

class BookListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Books List';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'books' => Book::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.book.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            BookListLayout::class
        ];
    }
}
