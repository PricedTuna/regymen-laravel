<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('success'))
                    <x-success-alert>
                        {{ session('success') }}
                    </x-success-alert>
                @endif
                <div class="p-6 text-gray-900">
                    <div class="flex gap-2 md:flex-row flex-col" >
                        <p class="font-bold text-md flex-1" >Train sessions: <span class="font-normal" >{{count($trainSessions)}}</span></p>
                        <p class="font-bold text-md flex-1">Primary muslces trained:
                            @foreach ($exercises as $exercise)
                                <span class="font-normal">{{implode(', ', $exercise->primaryMuscles->pluck('name')->toArray())}}</span>
                            @endforeach
                        </p>
                        <p class="font-bold text-md flex-1">Secondary muslces trained:
                            @foreach ($exercises as $exercise)
                                <span class="font-normal">{{implode(', ', $exercise->secondaryMuscles->pluck('name')->toArray())}}</span>
                            @endforeach
                        </p>
                    </div>

                    <div class="flex flex-col justify-center items-center mb-8">
                        <p class="p-2 font-bold text-lg">Train sessions</p>
                        <div class="max-w-xl">
                            <canvas id="trainSessionsChart"></canvas>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-2 justify-center items-center">
                        <div class="flex flex-col justify-center items-center">
                            <p class="p-2">Primary muscles</p>
                            <div class="max-w-xs">
                                <canvas id="primaryMusclesChart"></canvas>
                            </div>
                        </div>
                        <div class="max-w-xs">
                            <div class="flex flex-col justify-center items-center">
                                <p class="p-2">Secondary muscles</p>
                                <canvas id="secondaryMusclesChart"></canvas>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        function countOccurrences(array, element) {
            return array.reduce((count, currentItem) => {
                return currentItem === element ? count + 1 : count;
            }, 0);
        }

        function getPrimaryMainColor(trainSession) {

            let muscleColors = trainSession.trained_exercises.map(
                trainExercise => trainExercise.exercise.primary_muscles.map(muscle => muscle.color))

            const colorCount = {};

            muscleColors.forEach(color => {
                if (colorCount[color]) {
                    colorCount[color]++;
                } else {
                    colorCount[color] = 1;
                }
            });

            let maxCount = 0;
            let mostFrequentColor = null;

            for (const color in colorCount) {
                if (colorCount[color] > maxCount) {
                    maxCount = colorCount[color];
                    mostFrequentColor = color;
                }
            }

        }

        const exercisesArray = @json($exercises);
        const exercises = exercisesArray[0];

        let primaryMusclesName = exercises.primary_muscles.map(muscle => muscle.name);
        let primaryMusclesColor = exercises.primary_muscles.map(muscle => muscle.color);

        let secondaryMusclesName = exercises.secondary_muscles.map(muscle => muscle.name);
        let secondaryMusclesColor = exercises.secondary_muscles.map(muscle => muscle.color);

        let primaryOcurrences = primaryMusclesName.map(muscle => countOccurrences(primaryMusclesName, muscle));
        let secondaryOcurrences = secondaryMusclesName.map(muscle => countOccurrences(secondaryMusclesName, muscle));

        const primaryMusclesChart = document.getElementById('primaryMusclesChart');
        const secondaryMusclesChart = document.getElementById('secondaryMusclesChart');

        new Chart(primaryMusclesChart, {
            type: 'doughnut',
            data: {
                labels: primaryMusclesName,
                datasets: [{
                    label: 'Primary times trained',
                    data: primaryOcurrences,
                    backgroundColor: primaryMusclesColor,
                    hoverOffset: 4
                }]
            },
        });

        new Chart(secondaryMusclesChart, {
            type: 'doughnut',
            data: {
                labels: secondaryMusclesName,
                datasets: [{
                    label: 'Secondary muscles trained',
                    data: secondaryOcurrences,
                    backgroundColor: secondaryMusclesColor,
                    hoverOffset: 4
                }]
            },
        });


        const trainedSessions = @json($trainSessions);

        let sessionsName = trainedSessions.map(trainSession => trainSession.name);
        let sessionsMainColor = trainedSessions.map(trainSession => getPrimaryMainColor(trainSession));
        let sessionsCuantity = Array(sessionsName.length).fill(1);

        const trainSessionsChart = document.getElementById('trainSessionsChart');

        new Chart(trainSessionsChart, {
            type: 'doughnut',
            data: {
                labels: sessionsName,
                datasets: [{
                    label: 'Trained sessions',
                    data: sessionsCuantity,
                    backgroundColor: sessionsMainColor,
                    hoverOffset: 4
                }]
            },
        });




    </script>

</x-app-layout>