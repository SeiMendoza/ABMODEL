<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>hola mundo</title>
    @livewireStyles
</head>
<body>
   
    <div>
        <div style="text-align: center">
            <button wire:click="increment">+</button>
            <h1>{{ $count }}</h1>
        </div>
    </div>
    @livewireScripts
    <script src="/livewire/livewire.js"></script>
</body>
</html>

