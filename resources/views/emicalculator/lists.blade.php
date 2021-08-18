<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-full">
                    @if(!empty($histories->items()))
                        <div class="p-8 grid justify-items-center">
                            <table class="table-auto">
                                <thead>
                                <tr class="border bg-purple-600 bg-opacity-25 font-bold">
                                    <th class="p-3">Sr No</th>
                                    <th class="p-3">Principal Amount</th>
                                    <th class="p-3">Rate of Interest (In %)</th>
                                    <th class="p-3">Durations (In Month)</th>
                                    <th class="p-3">Date</th>
                                    <th class="p-3">Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($histories as $key => $history)
                                    <tr class="text-center">
                                        <td class="p-3">{{ $key+1 }}</td>
                                        <td class="p-3">{{ amount_format($history->principal_amount) }}</td>
                                        <td class="p-3">{{ $history->rate_of_interest }}</td>
                                        <td class="p-3">{{ $history->durations }}</td>
                                        <td class="p-3">{{ \Carbon::parse($history->created_at)->format('Y-m-d') }}</td>
                                        <td class="p-3"><a href="{{ route('emi-calculator.view', ['id' => $history->history_id]) }}" class="hover:underline">View Details</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-8 grid justify-items-between">
                            {{ $histories->links() }}
                        </div>
                    @else
                        <div class="flex items-center justify-center m-4 h-4">
                            No Records Found
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
