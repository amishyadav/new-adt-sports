<?php

namespace App\Http\Livewire;

use App\Models\AllMatch;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AllMatchesTable extends LivewireTableComponent
{
    protected $model = AllMatch::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'manage_matches.all_matches.add-button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('all_matches.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.matches.match_title'), "match_title")
                ->searchable()
                ->view('manage_matches.all_matches.columns.match_title')
                ->sortable(),
            Column::make(__('messages.matches.category_league'), "league_id")
                ->searchable()
                ->view('manage_matches.all_matches.columns.category_league')
                ->sortable(),
            Column::make(__('messages.matches.start_from_end_at'), "start_from")
                ->searchable()
                ->view('manage_matches.all_matches.columns.start_at_end_at')
                ->sortable(),
            Column::make(__('messages.matches.start_from_end_at'), "end_at")
                ->hideIf('end_at'),
            Column::make(__('messages.matches.status'), "status")
                ->view('manage_matches.all_matches.columns.status')
                ->sortable(),
            Column::make(__('messages.matches.action'), "id")
                ->view('manage_matches.all_matches.columns.action')
                ->sortable(),

        ];
    }
}
