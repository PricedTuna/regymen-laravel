@props(['color' => 'black', 'name' => '404', 'id' => 0])

<div class="flex items-center align-center bg-gray-100 p-4 rounded-lg shadow">
  <span class="mr-1 w-3 h-3 rounded-lg border-2 border-black" style="background-color: {{$color}};"></span>
  <span class="text-gray-800 font-medium">{{$name}}</span>
</div>