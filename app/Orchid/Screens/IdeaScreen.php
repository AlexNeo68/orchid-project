<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use App\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class IdeaScreen extends Screen
{

    public $message;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'name'  => 'Alexandr Chernyaev',
            // 'order' => Order::find(1),
            // 'orders' => Order::paginate(),
            'message' => 'Hello World!'
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->message;
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Вывести на печать')->method('print')
        ];
    }

    public function print(): void
    {
        Toast::warning('Сейчас будет выведено на печать');
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([
                Input::make('name')
                    ->value('')
                    ->placeholder('Type your name')
                    ->title('First Name')
                    ->help('What is your name?')
                    ->popover('This is tooltip!')
                    ->horizontal()
                    ->required()
                    ->canSee(true)
                    ->type('phone'),
                TextArea::make('description'),
                CheckBox::make('free')
                    ->value(1)
                    ->title('Free')
                    ->placeholder('Event for free')
                    ->help('Event for free')
                    ->sendTrueOrFalse(),
                Select::make('select')
                    ->title('Select tags')
                    ->help('Allow search bots to index')
                    ->fromModel(User::class, 'email')
                    ->empty('Не выбрано'),
                DateTimer::make('open')
                    ->title('Opening date')
                    ->allowInput(),
                Quill::make('html')
                    ->toolbar(["text", "color", "header", "list", "format", "media"]),
                Matrix::make('options')
                    ->columns([
                        'Attribute' => 'attr',
                        'Value' => 'product_value',
                    ]),
                Code::make('code')
                    ->language(Code::CSS),

                Picture::make('picture')
                    ->acceptedFiles('.jpg'),

                Cropper::make('picture')
                    ->width(500)
                    ->height(300),


                Upload::make('images')
                    ->groups('photo'),
                Group::make([
                    Input::make('first_name'),
                    Input::make('last_name'),
                ]),
                ModalToggle::make('Add Payment')
                    ->modal('addNewPayment')
                    ->icon('wallet')

            ])


        ];
    }
}
