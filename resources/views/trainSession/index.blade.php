<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Train sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                  <div>
                    <a href="{{route('trainSession.create')}}" class="inline-flex items-center mt-2 w-full justify-center px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >+</a>
                  </div>

                  <div class="flex flex-col gap-2" >
                    @foreach ($trainSessions as $trainSession)
                      <div class="bg-gray-200 border-2 border-gray-300 rounded-lg p-2">
                        <p class="font-bold text-lg">{{$trainSession->name}} <span class="font-normal text-sm ml-2">{{$trainSession->trainedDay}}</span></p>
                      </div>
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>