<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Time Table - Step1') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-full max-w-xs mx-auto">
                    <div class="bg-white shadow-md rounded ">
                        @if (count($errors) > 0)
                            <div class = "alert alert-danger px-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-500">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('timetable.step1.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="working_days">
                                    Number of Working Days (1 to 7)
                                </label>
                                <input class="number-only shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="working_days" name="working_days" type="number" placeholder="Working Days" min="1" max="7" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="subjects_per_day">
                                    Number of Subjects Per Day (1 to 8)
                                </label>
                                <input class="number-only shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="subjects_per_day" name="subjects_per_day" type="number" placeholder="Number of Subjects" min="1" max="8" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="total_subjects">
                                    Total Subjects
                                </label>
                                <input class="number-only shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="total_subjects" name="total_subjects" type="number" placeholder="Total Subjects" min="1" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Total Hours of Week: <span id="total_hours_week">0</span> Hours
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                    Next
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
