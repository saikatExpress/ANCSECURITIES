<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpenseExport implements FromCollection, WithHeadings
{
    protected $expenses;

    public function __construct($expenses)
    {
        $this->expenses = $expenses;
    }

    public function collection()
    {
        return $this->expenses->map(function($expense) {
            return [
                'ID' => $expense->id,
                'Date' => $expense->expense_date,
                'Amount' => $expense->amount,
                'Category' => $expense->expense_category,
                'Description' => $expense->description,
                'Staff Name' => $expense->staff->name ?? 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Amount',
            'Category',
            'Description',
            'Staff Name',
        ];
    }
}

