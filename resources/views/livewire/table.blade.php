<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calorie Table</title>
    <style>
        body {
            background-color: pink;
        }

    </style>
</head>
<body>


    <!-- Livewire table should be rendered here -->
    <div>
        @csrf
        <table>
        {{$this->table}}
        </table>






</body>
</div>
</html>
