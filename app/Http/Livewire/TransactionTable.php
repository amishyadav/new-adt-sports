<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DepositTransaction;

class TransactionTable extends LivewireTableComponent
{
    protected $model = DepositTransaction::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("User id", "user_id")
                ->view('transaction.column.user')
                ->sortable(),
            Column::make("Transaction id", "transaction_id")
                ->sortable(),
           
            Column::make("Amount", "amount")
                ->view('transaction.column.amount')
                ->sortable(),
            Column::make("Type", "type")
                ->view('transaction.column.type')
                ->sortable(),
          
            Column::make("Status", "status")
                ->view('transaction.column.status')
                ->sortable(),
            Column::make("Created at", "created_at")
                ->view('transaction.column.created_at')
                ->sortable(),
            
        ];
    }
    public function builder(): Builder
    {
        return DepositTransaction::with('user');
    }
}
