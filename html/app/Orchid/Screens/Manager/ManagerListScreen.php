<?php

namespace App\Orchid\Screens\Manager;

use Orchid\Screen\Screen;
use App\Models\Manager\Manager;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Books\BookListLayout;
use App\Orchid\Layouts\Manager\ManagerListLayout;

class ManagerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Managers List';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'managers' => Manager::paginate()
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
                ->route('platform.manager.edit')
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
            ManagerListLayout::class
        ];
    }
}
