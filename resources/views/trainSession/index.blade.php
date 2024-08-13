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
                      <div data-modal-target="train-session-{{$trainSession->id}}" data-modal-toggle="train-session-{{$trainSession->id}}" class="bg-gray-200 border-2 border-gray-300 rounded-lg p-2 cursor-pointer">
                        <p class="font-bold text-lg">{{$trainSession->name}} <span class="font-normal text-sm ml-2">{{$trainSession->trainedDay}}</span></p>
                      </div>

                      <!-- Train session modal -->
                      <div id="train-session-{{$trainSession->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                          <div class="relative p-4 w-full max-w-2xl max-h-full">
                              <!-- Modal content -->
                              <div class="relative bg-white rounded-lg shadow">
                                  <!-- Modal header -->
                                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                      <h3 class="text-xl font-semibold text-gray-900">
                                        <p class="font-bold text-lg">{{$trainSession->name}} <span class="font-normal text-sm ml-2">{{$trainSession->trainedDay}}</span></p>
                                      </h3>
                                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="train-session-{{$trainSession->id}}">
                                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                          </svg>
                                          <span class="sr-only">Close modal</span>
                                      </button>
                                  </div>
                                  <!-- Modal body -->
                                  <div class="p-4 xs:p-5 space-y-4 divide-x">
                                    @foreach ($trainSession->trainedExercises as $trainedExercise )
                                    <div class="flex flex-col md:flex-row gap-2" >
                                      <p class="font-bold text-lg" >{{$trainedExercise->exercise->name}}</p>
                                      <div class="flex gap-2">
                                        <p class="font-bold text-md" >Reps: <span class="font-normal text-sm" > {{$trainedExercise->reps}}</span></p>
                                        <p class="font-bold text-md" >Series: <span class="font-normal text-sm" > {{$trainedExercise->series}}</span></p>
                                      </div>
                                    </div>
                                    @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>


                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>