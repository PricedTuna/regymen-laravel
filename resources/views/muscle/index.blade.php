<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Muscles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 mb-3">
                    <form action="{{route('muscle.store')}}" method="post">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" name="name" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            <x-input-label for="color" :value="__('Color')" />
                            <x-color-input id="color" class="block mt-1 w-full" name="color" required />
                            <x-input-error :messages="$errors->get('color')" class="mt-2" />

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
                    @foreach ($muscles as $muscle)
                        <x-muscle-element color="{{$muscle->color}}" name="{{$muscle->name}}" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>