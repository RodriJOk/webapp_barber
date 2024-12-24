<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilidad horaria de un profesional</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <thead style="background-color: #f2f2f2;">
            <tr style="background-color: #f2f2f2;">
                <th colspan="5">Rodrigo Juarez</th>
            </tr>
            <tr>
                <th>Dia</th>
                <th>Hora de inicio</th>
                <th>Hora de fin</th>
                <th>Hora de inicio de descanso</th>
                <th>Hora de fin de descanso</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $availability)
                <tr>
                    <td>{{ $availability['day_of_the_week'] }}</td>
                    <td>{{ $availability['start_time'] }}</td>
                    <td>{{ $availability['end_time'] }}</td>
                    <td>{{ $availability['start_rest_time'] }}</td>
                    <td>{{ $availability['end_rest_time'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>