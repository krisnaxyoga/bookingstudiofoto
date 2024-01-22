@extends('layouts.admin')
@section('title', 'additional')
@section('content')
<script src="/fullcalendar-6.1.10/dist/index.global.js"></script>
<script src="/fullcalendar-6.1.10/dist/index.global.min.js"></script>
{{-- <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/web-component@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script> --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
  crossorigin="anonymous"></script>

<section>

    <div class="container mt-5">
        <div class="row">
            <div class="mb-3">
                <div class="panel-body">
                    <div class="filter-div d-flex justify-content-between">
                        <h2 class="title-bar no-border-bottom">
                            Rate Calendar
                        </h2>
                        <div class="col-right">
                            @if ($package->count() > 0)
                            <span class="count-string">
                                Showing 1 - {{ $package->count() }} of {{ $package->count() }} rooms
                            </span>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="user-panel">
                <div class="panel-title"><strong>Calendar</strong></div>
                <div class="panel-body no-padding" style="background: #f4f6f8; padding: 0px 15px;">
                    <div class="row">
                        <div class="col-md-3" style="border-right: 1px solid #dee2e6;">
                            <p class="font-weight-700">Room Type</p>
                            <ul class="nav nav-tabs flex-column vertical-nav">
                                @foreach ($package as $item)
                                <li class="nav-item event-name mb-2 btn btn-primary">
                                    <a class="nav-link p-0">
                                       {{$item->name}}
                                    </a>
                                </li>

                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-9" style="background: white; padding: 15px;">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
            </div>
            <div class="modal-body" id="eventDetails">
                <p><strong>Title:</strong> <span id="eventTitle"></span></p>
                <p><strong>Start Date:</strong> <span id="eventStartDate"></span></p>
                <p><strong>End Date:</strong> <span id="eventEndDate"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            events: function (info, successCallback, failureCallback) {
                // Ambil data dari server
                $.ajax({
                    url: '/calender/load_dates',
                    dataType: 'json',
                    data: {
                        start: info.startStr,
                        end: info.endStr
                    },
                    success: function (response) {
                        // Panggil successCallback dengan data dari server
                        successCallback(response);
                    },
                    error: function () {
                        // Panggil failureCallback jika ada kesalahan
                        failureCallback();
                    }
                });
            },
            viewDidMount: function(arg) {
            // Access the view object
            var view = arg.view;
            console.log('The view has been mounted:', view);

            // You can perform actions specific to the view here
            if (view.type === 'dayGridMonth') {
                // Code to execute when the view is in month mode
            } else if (view.type === 'dayGridWeek') {
                // Code to execute when the view is in week mode
            } else if (view.type === 'dayGridDay') {
                // Code to execute when the view is in day mode
            }
        },
            eventClick: function(info) {
                // Open modal with event details
                $('#eventTitle').text(info.event.title);
                $('#eventStartDate').text(info.event.startStr);
                $('#eventEndDate').text(info.event.endStr);
                $('#eventModal').modal('show');
            }
        });

        calendar.render();
    });
</script>
@endsection
