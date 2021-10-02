<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Time Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-full">
                    <div class="flex justify-center gap-6">
                        @foreach($timetable as $key => $day)
                            <div class="p-8 border-solid border-4 my-2">
                                <p class="font-bold">Day {{$key+1}}</p>
                                <ul>
                                    @foreach($day as $slot)
                                        <li>Subject {{$slot+1}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
