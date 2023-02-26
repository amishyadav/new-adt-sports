<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Language;

class LanguageTable extends LivewireTableComponent
{
    protected $model = Language::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'languages.add-button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->view('languages.columns.name')
                ->sortable(),
            Column::make("Iso code", "iso_code")
                ->view('languages.columns.iso_code')
                ->sortable(),
            Column::make("Translation", "id")
                ->view('languages.columns.translation')
                ->sortable(),
            Column::make("Action", "updated_at")
                ->view('languages.columns.action')
                ->sortable(),
        ];
    }
}
