<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\RegisteredPlayer;

class RegisteredPlayerTable extends LivewireTableComponent
{
    protected $model = RegisteredPlayer::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'registered_players.add-button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('registered_players.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make('Player ID', "user_id")
                ->searchable()
                ->view('registered_players.columns.name')
                ->sortable(),
            Column::make('ID', "id")
                ->hideIf('id'),
            Column::make( __('messages.category.status'), "status")
                ->view('registered_players.columns.status')
                ->sortable(),
            Column::make( 'Action', "created_at")
                ->view('registered_players.columns.action')
                ->sortable(),

        ];
    }
}
