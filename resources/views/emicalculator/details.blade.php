<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EMI Details') }}
        </h2>
    </x-slot>

    <?php
    $rate_of_interest = $history['rate_of_interest']/100/12;
    $principal_amount = $history['principal_amount'];
    $durations = $history['durations'];
    $monthly = calculate_monthly_emi($principal_amount, $rate_of_interest, $durations);
    $monthly_emi = round($monthly);
    $remaining = $principal_amount;

    $total_payable_amount = round($monthly*$durations);
    $total_paid_interest = 0;
    $total_payable_interest = round($monthly*$durations) - $principal_amount;
    $total_paid_principle = 0;
    $total_payable_principle = $principal_amount;
    ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-full">
                    <div class="p-2">
                        <a href="{{ route('emi-calculator.lists') }}" class="hover:underline"><<< Back to History</a>
                    </div>
                    <div class="flex justify-start gap-6">
                        <div class="p-8">
                            <table class="border-2 table-auto">
                                <tbody>
                                <tr class="border">
                                    <td class="p-1 font-bold">Principal Amount</td>
                                    <td class="p-1">{{ amount_format($principal_amount) }}</td>
                                </tr>
                                <tr class="border">
                                    <td class="p-1 font-bold">Rate of Interest</td>
                                    <td class="p-1">{{ $history['rate_of_interest'].'%' }}</td>
                                </tr>
                                <tr class="border">
                                    <td class="p-1 font-bold">Duration</td>
                                    <td class="p-1">{{ $durations.' Months' }}</td>
                                </tr>
                                <tr class="border">
                                    <td class="p-1 font-bold">Total Payment</td>
                                    <td class="p-1">{{ amount_format($total_payable_amount) }}</td>
                                </tr>
                                <tr class="border">
                                    <td class="p-1 font-bold">Monthly EMI</td>
                                    <td class="p-1">{{ amount_format($monthly_emi) }}</td>
                                </tr>
                                <tr class="border">
                                    <td class="p-1 font-bold">Total Interest</td>
                                    <td class="p-1">{{ amount_format($total_payable_interest) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-8">
                            <table class="table-auto">
                                <thead>
                                <tr class="border bg-purple-600 bg-opacity-25 font-bold">
                                    <td class="p-2">#</td>
                                    <td class="p-2">Installment Date</td>
                                    <td class="p-2">Starting Amount</td>
                                    <td class="p-2">Remaining Amount</td>
                                    <td class="p-2">Principle Amount</td>
                                    <td class="p-2">Interest Amount</td>
                                    <td class="p-2">Monthly EMI</td>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 1; $i <= $durations; $i++)
                                    @php
                                        $principle = $monthly_emi - round($principal_amount*$rate_of_interest);
                                        $interest = round($principal_amount*$rate_of_interest);
                                        if($i == $durations){
                                              $total_paid = (($durations-1) * $monthly_emi);
                                              $monthly_emi = (round($monthly*$durations)) - $total_paid;
                                              $interest = $total_payable_interest - $total_paid_interest;
                                              $principle = $total_payable_principle - $total_paid_principle;
                                        }
                                        $remaining -= $principle;
                                    @endphp
                                    <tr class="border">
                                        <td class="p-2">{{ $i }}</td>
                                        <td class="p-2">{{ \Carbon::parse($history['created_at'])->addMonths($i)->format('Y-m-d') }}</td>
                                        <td class="p-2">{{ amount_format($principal_amount) }}</td>
                                        <td class="p-2">{{ amount_format($remaining) }}</td>
                                        <td class="p-2">{{ amount_format($principle) }}</td>
                                        <td class="p-2">{{ amount_format($interest)}}</td>
                                        <td class="p-2">{{ amount_format($monthly_emi) }}</td>
                                    </tr>
                                    @php
                                        $total_paid_interest += $interest;
                                        $total_paid_principle += $principle;
                                        $principal_amount = $remaining;
                                    @endphp
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
