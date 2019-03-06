@extends('layouts.admin')

@section('title')
    Statistics Report
@endsection

@section('content')

<script type="text/javascript">
window.onload = function () {

var users = parseInt("{{ $users->count() }}", 10);
var vehicles = parseInt("{{ $vehicles->count() }}", 10);
var reserves = parseInt("{{ $reserves->count() }}", 10);

var data = [
    { label: "Total Users", count: users },
    { label: "Total Vehicles", count: vehicles },
    { label: "Total Reserves", count: reserves },

];

var dps=[];

$.each(data, function (i, item){
    dps.push({label: item.label, y: item.count});
});

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light2", "dark1", "dark2"
	animationEnabled: true, // change to true		
	title:{
		text: "Statistics Report"
	},
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "column",
		dataPoints: dps
	}
	]
});
chart.render();

}
</script>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h4 class="card-header">Statistics Report</h4>
                        <div class="card-body">
                            <h4 class="text-center mark font-weight-bold display-5 bg-warning">Volume</h4>
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
@endsection