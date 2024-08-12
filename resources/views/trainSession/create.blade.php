<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add train sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <form action="{{route('trainSession.store')}}" method="post">
                    @csrf
                    <input type="number" hidden value="1" id="exercisesCount" name="exercisesCount" />

                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" name="name" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <x-input-label for="trainedDay" :value="__('Trained day')" />
                    <x-text-input id="trainedDay" type="date" value="{{date('Y-m-d')}}" class="block mt-1 w-full" name="trainedDay" required />
                    <x-input-error :messages="$errors->get('trainedDay')" class="mt-2" />

                    <div id="trainedExercisesContainer" class="flex flex-col-reverse divide-y divide-y-reverse" >

                      <div id="exerciseContainer-1" class="flex flex-col justify-center gap-3 p-4 my-3 border-2 border-gray-300 rounded-lg bg-gray-100" >
                        <select name="exercises[]" class="flex-1 border-2 border-gray-300" id="exercises-1" autofocus >
                          @foreach ($exercises as $exercise)
                            <option value="{{$exercise->id}}" >{{$exercise->name}}</option>
                          @endforeach
                        </select>
                        <div class="flex items-center gap-2" >
                          <label for="reps-1">Repeticiones</label>
                          <input type="number" id="reps-1" name="reps[]" class="bg-gray-50 text-center border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                          <label for="series-1">Series</label>
                          <input type="number" id="series-1" name="series[]" class="bg-gray-50 text-center border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                      </div>

                    </div>
                    @error('name')
                      <h6 class="alert alert-danger">{{ $message }}</h6>
                    @enderror
                    @error('trainedDay')
                      <h6 class="alert alert-danger">{{ $message }}</h6>
                    @enderror
                    @error('exercisesCount')
                      <h6 class="alert alert-danger">{{ $message }}</h6>
                    @enderror
                    @error('exercises')
                      <h6 class="alert alert-danger">{{ $message }}</h6>
                    @enderror
                    @error('reps')
                      <h6 class="alert alert-danger">{{ $message }}</h6>
                    @enderror
                    @error('series')
                      <h6 class="alert alert-danger">{{ $message }}</h6>
                    @enderror

                    <div class="flex gap-2">
                      <button type="button" id="addExerciseBtn" class="inline-flex flex-1 items-center mt-2 w-full justify-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-400 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >Add exercise</button>
                      <button type="button" id="deleteExerciseBtn" class="inline-flex flex-1 items-center mt-2 w-full justify-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-400 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >Remove exercise</button>
                    </div>
                    <x-submit-button>
                      {{__("Save")}}
                    </x-submit-button>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <script>
      document.getElementById('addExerciseBtn').addEventListener('click', function() {
        let exercisesCounter = document.getElementById('exercisesCount');
        let nextId = exercisesCounter.value+1;
        exercisesCounter.value = nextId;

        const newContent = `
                      <div id="exerciseContainer-1" class="flex flex-col justify-center gap-3 p-4 my-3 border-2 border-gray-300 rounded-lg bg-gray-100" >
                        <select name="exercises[]" class="flex-1 border-2 border-gray-300" id="exercises-1" autofocus >
                          @foreach ($exercises as $exercise)
                            <option value="{{$exercise->id}}" >{{$exercise->name}}</option>
                          @endforeach
                        </select>
                        <div class="flex items-center gap-2" >
                          <label for="reps-1">Repeticiones</label>
                          <input type="number" id="reps-1" name="reps[]" class="bg-gray-50 text-center border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                          <label for="series-1">Series</label>
                          <input type="number" id="series-1" name="series[]" class="bg-gray-50 text-center border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                      </div>
                    `;

        document.getElementById('trainedExercisesContainer').insertAdjacentHTML('beforeend', newContent);
      });
      
      document.getElementById('deleteExerciseBtn').addEventListener('click', function(){
        let exercisesCounter = document.getElementById('exercisesCount');
        let idToDelete = exercisesCounter.value;
        let nextId = exercisesCounter.value-1;
        exercisesCounter.value = nextId;
        
        document.getElementById(`exerciseContainer-${idToDelete}`).remove();

      })
    
    </script>
</x-app-layout>