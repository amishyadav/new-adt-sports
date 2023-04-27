<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\HomeSlider;

class HomeSliderTable extends LivewireTableComponent
{
    protected $model = HomeSlider::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'cms.home_slider.add-button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('home_sliders.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make( __('messages.blog.image'), "id")
                ->view('cms.home_slider.columns.image'),
            Column::make( 'Main Title', "main_title")
                ->searchable()
                ->view('cms.home_slider.columns.main_title')
                ->sortable(),
            Column::make( 'Title', "title")
                ->view('cms.home_slider.columns.title')
                ->sortable(),
            Column::make('ID', "id")
                ->hideIf('id'),
            Column::make( 'Action', "created_at")
                ->view('cms.home_slider.columns.action_button')
                ->sortable(),

        ];
    }
}
