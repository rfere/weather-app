<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Weather App</title>
        <style>
            body {
                font-family: verdana;
            }
        </style>
    </head>
    <body>
        <h1>Weather App</h1>
        
        <form method="POST" action="/">
            @csrf
            <table>
                <tr>
                    <td><label for="latitude">Latitude</label></td>
                    <td><input type="text" id="latitude" name="latitude" required></td>
                </tr>
                <tr>
                    <td><label for="longitude">Longitude</label></td>
                    <td><input type="text" id="longitude" name="longitude" required></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
        <br>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (isset($latitude))
            <div>Latitude: {{ $latitude }}</div>
            <div>Longitude: {{ $longitude }}</div>
            <div>Celsius: {{ $celsius }}</div>
            <div>Fahrenheit: {{ $fahrenheit }}</div>
            <div>{{ $message }}</div>
        @endif
    </body>
</html>
