<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;

class CategoryTable extends LivewireTableComponent
{
    protected $model = Category::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'categories.add-button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('categories.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make( __('messages.category.name'), "name")
                ->searchable()
                ->view('categories.columns.name')
                ->sortable(),
            Column::make( __('messages.category.league'), "id")
                ->searchable()
                ->view('categories.columns.league')
                ->sortable(),
            Column::make( __('messages.category.status'), "status")
                ->view('categories.columns.status')
                ->sortable(),
            Column::make( __('messages.category.action'), "created_at")
                ->view('categories.columns.action')
                ->sortable(),

        ];
    }
}
