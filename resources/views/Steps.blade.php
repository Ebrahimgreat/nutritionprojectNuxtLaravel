<!Doctype html>
<html>
<x-layout>
    <x-slot:heading>
        <table>
            <th>Date</th>
            <th> Steps</th>
            @foreach($steps as $step)

                <td>{{$step['Date']}}<td>
                <td>{{$step['Month']}}<td>

                @endforeach


        </table>
    </x-slot:heading>
</x-layout>
</html>
