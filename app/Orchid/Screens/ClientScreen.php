<?php

namespace App\Orchid\Screens;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Orchid\Layouts\Clients\ClientsListTable;
use App\Orchid\Layouts\Clients\CreateUpdateClientRows;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ClientScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'clients' => Client::filters()->defaultSort('status', 'desc')->paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Клиенты');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Создать клиента')
            ->modal('createClient')
            ->method('create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ClientsListTable::class,
            Layout::modal('createClient', [
                CreateUpdateClientRows::class
            ])->title('Создание клиента')->applyButton('Создать')
        ];
    }

    public function createOrUpdate(ClientRequest $request): void
    {
        $clientId = $request->input('client.id');
        Client::updateOrCreate(['id'=>$clientId], array_merge($request->validated()['client'], [
            'status' => 'interviewed',
        ]));

        is_null($clientId) ? Toast::info('Клиент создан') : Toast::info('Клиент обновлен');
        
    }
}
