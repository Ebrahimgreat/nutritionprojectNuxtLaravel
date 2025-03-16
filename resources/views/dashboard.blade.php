
<x-layout>
    <x-slot:heading>
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Hello</h1>

        @foreach($user as $u)
            {{$u['name']}}

        @endforeach


        <br>  Date: {{\Carbon\Carbon::today()->format('Y-m-d')}}
        <br> Goal: @foreach($goals as $goal)
                       {{$goal['name']}}
        @endforeach

    </x-slot:heading>


       {{$targetCalories}}
    @foreach($getStats as $stats)
        {{$stats}}
    @endforeach
    @foreach($getWeight as $stats)
        {{$stats}}
    @endforeach


</x-layout>
