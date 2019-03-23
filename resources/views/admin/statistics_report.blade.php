@extends('layouts.admin')

@section('title')
    Statistics Report
@endsection

@section('content')

<script type="text/javascript">
window.onload = function () {

var data = [
    { label: "Average", count: parseInt("{{ $data['avt'] }}", 10) },

];

var dps=[];

$.each(data, function (i, item){
    dps.push({label: item.label, y: item.count});
});

// Average Ticket Value
var chart = new CanvasJS.Chart("atvChart", {
	theme: "light2", // "light2", "dark1", "dark2"
	animationEnabled: true, // change to true		
	title:{
		text: "Average Ticket Value"
    },
    axisY: {
		includeZero: false,
        prefix: "₱"
    },
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
        type: "column",
        color: "#7ad9ff",
		percentFormatString: "#0.##",
		dataPoints: dps
	}
	]
});

// Frequency of Use
var chart2 = new CanvasJS.Chart("freqChart", {
        theme: "light2", // "light2", "dark1", "dark2"
        animationEnabled: true, // change to true		
        title:{
            text: "Frequency of Use"
        },
        axisY: {
		    includeZero: true,
        },
        data: [
        {
            // Change type to "bar", "area", "spline", "pie",etc.
            type: "pie",
            color: "#ee6572",
            dataPoints: [
                { label: "Frequency",  y: parseFloat("{{ $data['frq'] }}")  },
            ]
        }
        ]
    });

    // Average Length of Stay
    var chart3 = new CanvasJS.Chart("alsChart", {
        theme: "light2", // "light2", "dark1", "dark2"
        animationEnabled: true, // change to true		
        title:{
            text: "Average Length of Stay"
        },
        axisY: {
		    includeZero: false,
        },
        data: [
        {
            // Change type to "bar", "area", "spline", "pie",etc.
            type: "bar",
            dataPoints: [
                { label: "Hours", y: parseInt("{{ $data['als'] }}", 10) },
            ]
        }
        ]
    });

chart.render();
chart2.render();
chart3.render();

}
</script>

    <div class="main-panel">
        <div class="content-wrapper">
            <h4 class="text-center mark font-weight-bold display-5 bg-warning mb-4">Statistics Report</h4>
            <div class="row">
                <div class="col-lg-6 col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div id="atvChart" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div id="alsChart" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            
        <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div id="freqChart" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
@endsection