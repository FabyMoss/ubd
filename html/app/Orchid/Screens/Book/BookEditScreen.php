<?php

namespace App\Orchid\Screens\Book;

use Orchid\Screen\Screen;
use App\Models\Books\Book;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;

class BookEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create a new Book';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Book $book): array
    {
        $this->exists = $book->exists;

        if($this->exists){
            $this->name = 'Edit book';
        }

        return [
            'book' => $book
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
            Button::make('Create book')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee(!$this->exists),
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
                Input::make('book.title')
                    ->title('Title')
                    ->placeholder('Add a book title')
                    ->help('Specify a title for this Book.'),

                Input::make('book.author')
                    ->title('author')
                    ->placeholder('Add the author for this Book'),

                Input::make('book.year')
                    ->type('number')
                    ->title('year')
                    ->placeholder('Add the release year for this Book'),
            ])
        ];
    }


   /**
     * @param Post    $post
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Book $book, Request $request)
    {
        $book->fill($request->get('book'))->save();

        Alert::info('You have successfully added a book.');

        return redirect()->route('platform.book.list');
    }

        /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Book $book)
    {
        $book->delete();

        Alert::info('You have successfully deleted the book.');

        return redirect()->route('platform.book.list');
    }
}
