<?php

namespace App\Http\Livewire;

use App\Models\DepositTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AppointmentTransaction;

class UserPaymentTable extends LivewireTableComponent
{
    protected $model = DepositTransaction::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'deposit.add_button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
           
            Column::make("Transaction id", "transaction_id")
                ->sortable(),
            Column::make("Amount", "amount")
                ->view('deposit.column.amount')
                ->sortable(),
            Column::make("Type", "type")
                ->view('deposit.column.type')
                ->sortable(),
            Column::make("Status", "status")
                ->view('deposit.column.status')
                ->sortable(),
            Column::make("Created at", "created_at")
                ->view('deposit.column.created_at')
                ->sortable(),
         
        ];
    }
    public function builder(): Builder
    {
        return DepositTransaction::whereUserId(getLogInUserId());
    }

}
