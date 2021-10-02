<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Time Table - Step2') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-full">
                    <div class="flex justify-start gap-6">
                        <div class="p-8">
                            <table class="border-2 table-auto">
                                <tbody>
                                <tr class="border">
                                    <td class="p-1 font-bold">Working Days</td>
                                    <td class="p-1">{{ $history['working_days'] }}</td>
                                </tr>
                                <tr class="border">
                                    <td class="p-1 font-bold">Subjects Per Day</td>
                                    <td class="p-1">{{ $history['subjects_per_day'] }}</td>
                                </tr>
                                <tr class="border">
                                    <td class="p-1 font-bold">Total Subjects</td>
                                    <td class="p-1">{{ $history['total_subjects'] }}</td>
                                </tr>
                                <tr class="border">
                                    <td class="p-1 font-bold">Total Weekly Hours</td>
                                    <td class="p-1">{{ $history->totalWeeklyHours }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-8">
                            <h3 class="font-bold">Subject wise hours</h3>
                            @if (count($errors) > 0)
                                <div class = "alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="text-red-500">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-5 gap-4" method="POST" action="{{ route('timetable.generate',$history['history_id']) }}">
                                @csrf
                                @for ($i = 0; $i < $history['total_subjects']; $i++)
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="subjects{{$i}}">
                                        Subject {{$i+1}}
                                    </label>
                                    <input class="number-only shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="subjects{{$i}}" name="subjects[{{$i}}]" type="number" placeholder="Subject {{$i+1}}" min="1" required>
                                </div>
                                @endfor
                                <div class="flex items-center justify-between">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                        Generate
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
