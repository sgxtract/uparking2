@extends('layouts.admin')

@section('title')
Sales Report
@endsection

@section('content')

<script type="text/javascript">
window.onload = function () {

var num = parseInt("{{ $payment }}", 10);

var data = [
    { label: "Sales Revenue", count: num },
];

var dps=[];

$.each(data, function (i, item){
    dps.push({label: item.label, y: item.count});
});

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light2", "dark1", "dark2"
	animationEnabled: true, // change to true		
	title:{
		text: "Sales Report"
	},
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "bar",
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
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <h4 class="card-header">Sales Report</h4>
                    <div class="card-body">
                        <h4 class="text-center mark font-weight-bold display-5 bg-warning">in Philippine Currency (PHP)</h4>
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
@endsection
