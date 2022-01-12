<?php

namespace App\Orchid\Screens\Bookstore;

use Orchid\Screen\Screen;
use App\Models\Books\Bookstore;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Books\BookstoreListLayout;

class BookstoreListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Bookstore List';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'bookstores' => Bookstore::paginate()
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
                ->route('platform.bookstore.edit')
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
            BookstoreListLayout::class
        ];
    }
}
