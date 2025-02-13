@extends('client.app', ['title' => 'billing'])
@push('style')
 <!-- FullCalendar CSS -->
 <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.3.0/dist/fullcalendar.min.css" rel="stylesheet">
    <style>
        /* Custom CSS to highlight the booked dates */
        .booked {
            background-color: red !important;
            color: white !important;
        }
      
    </style>
@endpush
@section('content')


<div class="container">

<div id="calendar" class="mt-5"></div>
</div>

@endsection

@push('script')
<!-- jQuery (required by FullCalendar) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.3.0/dist/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function() {
            var bookedDates = @json($order_dates->pluck('created_date'));  // Get the created_at dates from the server

            // Initialize FullCalendar
            $('#calendar').fullCalendar({
                // The calendar's dayRender event is triggered when a user views a day
                dayRender: function(date, cell) {
                    var dateString = date.format('YYYY-MM-DD'); // Get the date in format YYYY-MM-DD

                    // If the date is in the list of booked dates, highlight it
                    if (bookedDates.includes(dateString)) {
                        cell.addClass('booked'); 
                    }
                }
            });
        });
    </script>
@endpush