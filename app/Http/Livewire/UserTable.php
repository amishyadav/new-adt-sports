<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class UserTable extends LivewireTableComponent
{
    protected $model = User::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'users.add_button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
    public function columns(): array
    {
        return [
            Column::make("Profile", "id")
                ->view('users.columns.full_name')
                ->sortable(),
            Column::make("First name", "first_name")
                ->hideIf('first_name')
                ->sortable(),
            Column::make("Last name", "last_name")
                ->hideIf('last_name')
                ->sortable(),
            Column::make("Email", "email")
                ->hideIf('email')
                ->sortable(),
            Column::make("Email", "email")
                ->hideIf('email')
                ->sortable(),
            Column::make("contact", "contact")
                ->view('users.columns.contact')
                ->sortable(),
            Column::make("IMPERSONATE", "contact")
                ->view('users.columns.inpersonate')
                ->sortable(),
            Column::make("status", "status")
                ->view('users.columns.status')
                ->sortable(),
            Column::make("Action", "region_code")
                ->view('users.columns.action')
                ->sortable(),
        ];
    }
    public function builder(): Builder
    {
        return User::with('address')->orderByDesc('id');
    }
}
