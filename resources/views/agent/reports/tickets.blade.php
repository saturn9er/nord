@extends('agent.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            <h2 class="font-weight-bold">@lang('report.report') "@lang('report.tickets')"</h2>
            <div class="card" style="margin-bottom: 10px;">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-12" id="datepicker-container">
                            <label class="font-weight-bold" for="datepicker">@lang('report.date')</label>
                            <div class="input-group date" id="datepicker">
                                <input value="{{ $date }}" name="date" type="text" class="form-control" id="datepicker-input" style="border-radius: .25rem;" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bold">@lang('report.tickets_demand_stat')</h4>
                    <div id="chart_div"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.ru.min.js"></script>
<script>
    jQuery(document).ready(function($){
        $('#datepicker').datepicker({
            format: "dd-mm-yyyy",
            language: "ru",
            maxViewMode: 0
        });
        $('#datepicker-input').change(function(){
            var date = $('#datepicker-input').val();
            window.location.href = '{{ url('agent/reports/tickets').'/' }}'+date;
        });
    });
</script>
<script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
            ['@lang("report.tickets")', '@lang("report.tickets")', { role: 'style'}],
            ['@lang("report.not_sold")', {{ $notSoldTickets->seats_left }}, 'green'],
            ['@lang("report.sold")', {{ $soldTickets }}, 'blue'],
            ['@lang("report.returned")', {{ $returnedTickets }}, 'red']
        ]);

        // Set chart options
        var options = {'title':'@lang("report.tickets_demand_stat")',
            'width':450,
            'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
@endsection
