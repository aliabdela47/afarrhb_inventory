<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $issuance->reference_number }} - Print</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 20px; }
        }
    </style>
</head>
<body class="bg-white">
    <div class="max-w-4xl mx-auto p-8">
        <!-- Print Button -->
        <div class="no-print mb-4">
            <button onclick="window.print()" class="btn btn-primary">
                {{ app()->getLocale() === 'am' ? 'አትም' : 'Print' }}
            </button>
            <button onclick="window.close()" class="btn btn-secondary ml-2">
                {{ app()->getLocale() === 'am' ? 'ዝጋ' : 'Close' }}
            </button>
        </div>

        <!-- Header -->
        <div class="text-center mb-8 border-b-2 border-gray-900 pb-4">
            <h1 class="text-2xl font-bold">
                {{ app()->getLocale() === 'am' ? 'የአፋር ክልል ጤና ቢሮ' : 'Afar Regional Health Bureau' }}
            </h1>
            <p class="text-lg mt-2">
                {{ $issuance->type === 'model_19' ? 
                   (app()->getLocale() === 'am' ? 'ሞዴል-19 የእቃ ወጪ ቅፅ' : 'Model-19 Item Issuance Form') : 
                   (app()->getLocale() === 'am' ? 'ሞዴል-22 የእቃ ወጪ ቅፅ' : 'Model-22 Item Issuance Form') 
                }}
            </p>
        </div>

        <!-- Issuance Information -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p><strong>{{ app()->getLocale() === 'am' ? 'ቁጥር:' : 'Reference Number:' }}</strong> {{ $issuance->reference_number }}</p>
                <p><strong>{{ app()->getLocale() === 'am' ? 'ቀን:' : 'Date:' }}</strong> {{ $issuance->issue_date->format('Y-m-d') }}</p>
                <p><strong>{{ app()->getLocale() === 'am' ? 'መጋዘን:' : 'Warehouse:' }}</strong> {{ $issuance->warehouse->name }}</p>
            </div>
            <div>
                <p><strong>{{ app()->getLocale() === 'am' ? 'ሰራተኛ:' : 'Employee:' }}</strong> {{ $issuance->employee->name }}</p>
                <p><strong>{{ app()->getLocale() === 'am' ? 'መታወቂያ:' : 'ID:' }}</strong> {{ $issuance->employee->emp_id }}</p>
                <p><strong>{{ app()->getLocale() === 'am' ? 'ክፍል:' : 'Department:' }}</strong> {{ $issuance->employee->department }}</p>
            </div>
        </div>

        @if($issuance->purpose)
        <div class="mb-6">
            <p><strong>{{ app()->getLocale() === 'am' ? 'ዓላማ:' : 'Purpose:' }}</strong> {{ $issuance->purpose }}</p>
        </div>
        @endif

        <!-- Items Table -->
        <table class="w-full border-collapse border border-gray-900 mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-900 px-4 py-2 text-left">#</th>
                    <th class="border border-gray-900 px-4 py-2 text-left">{{ app()->getLocale() === 'am' ? 'የእቃ ስም' : 'Item Name' }}</th>
                    <th class="border border-gray-900 px-4 py-2 text-left">{{ app()->getLocale() === 'am' ? 'ኮድ' : 'Code' }}</th>
                    <th class="border border-gray-900 px-4 py-2 text-center">{{ app()->getLocale() === 'am' ? 'ብዛት' : 'Quantity' }}</th>
                    <th class="border border-gray-900 px-4 py-2 text-right">{{ app()->getLocale() === 'am' ? 'ዋጋ' : 'Unit Price' }}</th>
                    <th class="border border-gray-900 px-4 py-2 text-right">{{ app()->getLocale() === 'am' ? 'ጠቅላላ' : 'Total' }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($issuance->items as $index => $item)
                <tr>
                    <td class="border border-gray-900 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-900 px-4 py-2">{{ $item->item->name }}</td>
                    <td class="border border-gray-900 px-4 py-2">{{ $item->item->code }}</td>
                    <td class="border border-gray-900 px-4 py-2 text-center">{{ $item->quantity_issued ?: $item->quantity_requested }}</td>
                    <td class="border border-gray-900 px-4 py-2 text-right">{{ number_format($item->unit_price, 2) }}</td>
                    <td class="border border-gray-900 px-4 py-2 text-right">{{ number_format(($item->quantity_issued ?: $item->quantity_requested) * $item->unit_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Signatures -->
        <div class="grid grid-cols-3 gap-8 mt-12">
            <div class="text-center">
                <div class="border-t border-gray-900 pt-2 mt-16">
                    <p class="font-semibold">{{ app()->getLocale() === 'am' ? 'የተከፋፈለው' : 'Issued By' }}</p>
                    <p class="text-sm">{{ $issuance->issuedBy->name }}</p>
                </div>
            </div>
            <div class="text-center">
                <div class="border-t border-gray-900 pt-2 mt-16">
                    <p class="font-semibold">{{ app()->getLocale() === 'am' ? 'ያረጋገጠው' : 'Approved By' }}</p>
                </div>
            </div>
            <div class="text-center">
                <div class="border-t border-gray-900 pt-2 mt-16">
                    <p class="font-semibold">{{ app()->getLocale() === 'am' ? 'ተቀባይ' : 'Received By' }}</p>
                    <p class="text-sm">{{ $issuance->employee->name }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
