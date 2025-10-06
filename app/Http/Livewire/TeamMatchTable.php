<?php

namespace App\Http\Livewire;

use App\Models\TeamMatch;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TeamMatchTable extends LivewireTableComponent
{
    protected $model = TeamMatch::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'team_match.add-button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('team_matches.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("Team 1", "team1_id")
                ->view('team_match.columns.team1_id')
                ->sortable(),
            Column::make('Team 2', "team2_id")
                ->searchable()
                ->view('team_match.columns.team2_id')
                ->sortable(),
            Column::make( 'Status', "status")
                ->view('team_match.columns.status')
                ->sortable(),
            Column::make( 'Action', "created_at")
                ->view('team_match.columns.action')
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        return TeamMatch::with('team1','team2')->where('user_id','=',getLogInUserId())->orderByDesc('id');
    }
}
