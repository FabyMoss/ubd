<?php

namespace App\Orchid\Screens\Bookstore;

use Orchid\Screen\Screen;
use App\Models\Address\City;
use Illuminate\Http\Request;
use App\Models\Books\Bookstore;
use App\Models\Manager\Manager;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;

class BookstoreEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create a new Bookstore';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Bookstore $bookstore): array
    {
        $this->exists = $bookstore->exists;

        if($this->exists){
            $this->name = 'Edit bookstore';
        }

        return [
            'bookstore' => $bookstore
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
            Button::make('Create bookstore')
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
                Input::make('bookstore.name')
                    ->title('Name')
                    ->placeholder('Add bookstore name')
                    ->help('Specify a name for this post.'),

                TextArea::make('bookstore.address')
                    ->title('Address')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Full Address for this Bookstore'),

                Relation::make('bookstore.city_id')
                    ->title('City')
                    ->fromModel(City::class, 'name'),

                Relation::make('bookstore.manager_id')
                    ->title('Manager')
                    ->fromModel(Manager::class, 'name'),

            ])
        ];
    }


   /**
     * @param Post    $post
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Bookstore $bookstore, Request $request)
    {
        $bookstore->city_id = $request->get('bookstore')['city_id'];
        $bookstore->manager_id = $request->get('bookstore')['manager_id'];
        $bookstore->address = $request->get('bookstore')['address'];
        $bookstore->name = $request->get('bookstore')['name'];

        $bookstore->save();

        Alert::info('You have successfully created a bookstore.');

        return redirect()->route('platform.bookstore.list');
    }

        /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Bookstore $bookstore)
    {
        $bookstore->delete();

        Alert::info('You have successfully deleted the bookstore.');

        return redirect()->route('platform.bookstore.list');
    }
}
