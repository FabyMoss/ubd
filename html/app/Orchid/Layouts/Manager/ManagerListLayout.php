<?php

namespace App\Orchid\Layouts\Manager;

use Orchid\Screen\TD;
use App\Models\Manager\Manager;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class ManagerListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'managers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->render(function (Manager $manager) {
                    return Link::make($manager->name)
                        ->route('platform.manager.edit', $manager);
                }),

            TD::make('age', 'Age'),
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
