<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js'></script>
        <title>Solicitar un turno</title>
        <style>
            body{
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                margin: 0px;
                padding: 0px;
                box-sizing: border-box;
            }
        </style>
    </head>
    <body>
        <main style="display: flex; flex-direction: row;">
            @include('layout.sidebar')
            <div style="min-width: 70%; padding: 10px; margin: 0 auto; position: relative; margin-left: 350px;">
                <form action="{{route('create_event')}}" method="POST">
                    @csrf
                    <h1>Solicitar un turno</h1>
                    <div>
                        <label for="title">Nombre</label>
                        <input type="text" name="title" id="title" required>
                    </div>
                    <div>
                        <label for="start">Fecha y hora de inicio</label>
                        <input type="datetime-local" name="start" id="start" required>
                    </div>
                    <div>
                        <label for="end">Fecha y hora de fin</label>
                        <input type="datetime-local" name="end" id="end" required>
                    </div>
                    <div>
                        <button type="submit">Solicitar turno</button>
                    </div>
                </form>
            </div>   
        </main>
        {{-- <div id="calendar"></div> --}}
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                locale: 'es',
                headerToolbar: {
                    right: 'timeGridWeek,timeGridDay,listWeek',
                    center: 'title',
                    left: 'prev,next'
                },
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            });
            calendar.render();
        });
    </script>
</html>