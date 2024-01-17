@extends('layouts.admin')
@section('title', 'additional')
@section('content')
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar'></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('fullCalendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: ['timeGrid'],
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'timeGridWeek,timeGridDay'
    },
    initialDate: '2024-01-17',
    selectable: true,
    select: function (info) {
      // Handle the selection of a time range
      alert('Selected ' + info.startStr + ' to ' + info.endStr);
    },
    events: [
      {
        title: 'Event 1',
        start: '2024-01-17T10:00:00',
        end: '2024-01-17T12:00:00'
      },
      {
        title: 'Event 2',
        start: '2024-01-17T14:00:00',
        end: '2024-01-17T16:00:00'
      }
      // Add more events as needed
    ]
  });

  calendar.render();
});
</script>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id='fullCalendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
