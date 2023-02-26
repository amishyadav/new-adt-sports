<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Role;

class RoleTable extends LivewireTableComponent
{
    protected $model = Role::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'roles.add_button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setThAttributes(function(Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'd-flex justify-content-center',
                ];
            }
            return [];
        });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '2') {
                return [
                    'class' => 'text-center',
                    'width' => '10%',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make("name", "name")
                ->sortable(),
            Column::make("Permission", "created_at")
                ->view('roles.columns.permission')
                ->sortable(),
            Column::make("Action", "id")
                ->view('roles.columns.action')
                ->sortable(),
        ];
    }

    /**
     * @return Builder
     */
    public function builder(): Builder
    {
        $query = Role::with('permissions');
        return $query;
    }
}
