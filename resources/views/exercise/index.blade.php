<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exercises') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 mb-1">
                    <form action="{{route('exercise.store')}}" method="post">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" name="name" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            <div class="mt-2" >
                                <label for="primary_muscles">Primary Muscles:</label>
                                <span id="primary_muscles_selected" ></span>
                            </div>
                            <!-- primary Modal toggle -->
                            <button data-modal-target="primary-muscles-modal" data-modal-toggle="primary-muscles-modal"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                type="button">
                                Select muscles
                            </button>

                            <!-- primary muscles modal -->
                            <div id="primary-muscles-modal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                            <h3 class="text-xl font-semibold text-gray-900">
                                                Select principal muscles
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-hide="primary-muscles-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <p class="text-base leading-relaxed text-gray-500">
                                                Hold cntrl (cmnd in mac) and select the muscles
                                            </p>
                                            <select class="w-full" name="primary_muscles[]" id="primary_muscles"
                                                multiple>
                                                @foreach($muscles as $muscle)
                                                    <option value="{{ $muscle->id }}">{{ $muscle->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2">
                                <label for="secondary_muscles">Secondary muscles:</label>
                                <span id="secondary_muscles_selected" ></span>
                            </div>
                            <!-- secondary Modal toggle -->
                            <button data-modal-target="secondary-muscles-modal" data-modal-toggle="secondary-muscles-modal"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                type="button">
                                Select muscles
                            </button>
                            <!-- secondary muscles modal -->
                            <div id="secondary-muscles-modal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                            <h3 class="text-xl font-semibold text-gray-900">
                                                Select secondary muscles
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-hide="secondary-muscles-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <p class="text-base leading-relaxed text-gray-500">
                                                Hold cntrl (cmnd in mac) and select the muscles
                                            </p>
                                            <select class="w-full" name="secondary_muscles[]" id="secondary_muscles" multiple>
                                                @foreach($muscles as $muscle)
                                                    <option value="{{ $muscle->id }}">{{ $muscle->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <x-submit-button>
                                {{ __('Save') }}
                            </x-submit-button>

                        </div>
                    </form>
                </div>

                @if (session('success'))
                    <x-success-alert>
                        {{ session('success') }}
                    </x-success-alert>
                @endif
                <div class="p-6 text-gray-900 flex flex-col gap-3">
                        @foreach ($exercises as $exercise)
                            <div class="flex flex-col align-center bg-gray-100 p-4 rounded-lg shadow">
                                <p class="text-gray-900 font-bold text-lg">{{$exercise->name}}</p>
                                <p class="text-gray-800 font-medium">Primary muscles: {{implode(', ', $exercise->primaryMuscles->pluck('name')->toArray() )}} </p>
                                <p class="text-gray-800 font-medium">Secondary muscles: {{implode(', ', $exercise->secondaryMuscles->pluck('name')->toArray() )}} </p>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>