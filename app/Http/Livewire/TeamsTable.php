<?php

namespace App\Http\Livewire;

use App\Models\Teams;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TeamsTable extends LivewireTableComponent
{
    protected $model = Teams::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'teams.add-button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('teams.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("Logo", "id")
                ->view('teams.columns.profile')
                ->sortable(),
            Column::make('Name', "name")
                ->searchable()
                ->view('teams.columns.name')
                ->sortable(),
            Column::make( 'Status', "status")
                ->view('teams.columns.status')
                ->sortable(),
            Column::make( 'Action', "created_at")
                ->view('teams.columns.action')
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        return Teams::where('user_id','=',getLogInUserId())->orderByDesc('id');
    }
}
