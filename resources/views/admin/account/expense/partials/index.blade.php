@foreach ($expenses as $expense)
    <tr class="list-item">
        <td>{{ $expense->id }}</td>
        <td>{{ $expense->staff->name }}</td>
        <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}</td>
        <td>{{ $expense->amount }}</td>
        <td>{{ $expense->expense_category }}</td>
        <td>{{ $expense->description }}</td>
        <td>
            @if ($expense->receipt_image)
                <a href="{{ asset('storage/' . $expense->receipt_image) }}" target="_blank">View Receipt</a>
            @else
                No Receipt
            @endif
        </td>
        @if ($expense->status === 'accepted')
            <td style="text-transform: uppercase;color:#fff;" class="btn btn-sm btn-success">
                {{ $expense->status }}
            </td>
        @else
            <td style="text-transform: uppercase;color:#fff;" class="btn btn-sm btn-danger">
                {{ $expense->status }}
            </td>
        @endif
        <td>
            <a class="btn btn-sm btn-primary">
                Edit
            </a>
            <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $expense->id }}">
                Delete
            </button>
        </td>
    </tr>
@endforeach
