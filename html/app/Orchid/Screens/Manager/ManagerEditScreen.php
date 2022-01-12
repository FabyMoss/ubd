<?php

namespace App\Orchid\Screens\Manager;

use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\Manager\Manager;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;

class ManagerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Add a new manager';
    public $exists = false;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Manager $manager): array
    {
        $this->exists = $manager->exists;

        if($this->exists){
            $this->name = 'Edit manager';
        }

        return [
            'manager' => $manager
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
            Button::make('Create manager')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
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
            Layout::rows([
                Input::make('manager.name')
                    ->title('Name')
                    ->placeholder('Add a name for manager')
                    ->help('Specify the name for this manager.'),

                    Input::make('manager.age')
                    ->type('number')
                    ->title('age')
                    ->placeholder('Add the age for this manager'),
            ])
        ];
    }


   /**
     * @param Post    $post
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Manager $manager, Request $request)
    {
        $manager->fill($request->get('manager'))->save();

        Alert::info('You have successfully added a manager.');

        return redirect()->route('platform.manager.list');
    }

        /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Manager $manager)
    {
        $manager->delete();

        Alert::info('You have successfully deleted this manager.');

        return redirect()->route('platform.manager.list');
    }
}
