@extends('layouts.admin')

@section('title')
Sales Report
@endsection

@section('content')

<script type="text/javascript">
    window.onload = function () {

    var data = [
        { label: "Sunday", count: parseInt("{{ $data['sunday'] }}", 10) },
        { label: "Monday", count: parseInt("{{ $data['monday'] }}", 10) },
        { label: "Tuesday", count: parseInt("{{ $data['tuesday'] }}", 10) },
        { label: "Wednesday", count: parseInt("{{ $data['wednesday'] }}", 10) },
        { label: "Thursday", count: parseInt("{{ $data['thursday'] }}", 10) },
        { label: "Friday", count: parseInt("{{ $data['friday'] }}", 10) },
        { label: "Saturday", count: parseInt("{{ $data['saturday'] }}", 10) },
    ];

    var dpsDaily=[];    

    $.each(data, function (i, item){
        dpsDaily.push({label: item.label, y: item.count});
    });
    
    // Daily
    var chart = new CanvasJS.Chart("dailyChart", {
        theme: "light2", // "light2", "dark1", "dark2"
        animationEnabled: true, // change to true		
        title:{
            text: "Daily Sales Report"
        },
        axisY: {
		    includeZero: false,
            prefix: "₱"
        },
        data: [
        {
            // Change type to "bar", "area", "spline", "pie",etc.
            type: "spline",
            dataPoints: dpsDaily
        }
        ]
    });

    // Weekly
    var chart2 = new CanvasJS.Chart("weeklyChart", {
        theme: "light2", // "light2", "dark1", "dark2"
        animationEnabled: true, // change to true		
        title:{
            text: "Weekly Sales Report"
        },
        axisY: {
		    includeZero: false,
            prefix: "₱"
        },
        data: [
        {
            // Change type to "bar", "area", "spline", "pie",etc.
            type: "bar",
            dataPoints: [
                { label: "Week",  y: parseInt("{{ $data['weekly'] }}", 10)  },
            ]
        }
        ]
    });

    // Monthly
    var chart3 = new CanvasJS.Chart("monthlyChart", {
        theme: "light2", // "light2", "dark1", "dark2"
        animationEnabled: true, // change to true		
        title:{
            text: "Monthly Sales Report"
        },
        axisY: {
		    includeZero: false,
            prefix: "₱"
        },
        data: [
        {
            // Change type to "bar", "area", "spline", "pie",etc.
            type: "area",
            dataPoints: [
                { label: "January",  y: parseInt("{{ $data2['jan'] }}", 10)  },
                { label: "February", y: parseInt("{{ $data2['feb'] }}", 10)  },
                { label: "March", y: parseInt("{{ $data2['mar'] }}", 10)  },
                { label: "April",  y: parseInt("{{ $data2['apr'] }}", 10)  },
                { label: "May",  y: parseInt("{{ $data2['may'] }}", 10)  },
                { label: "June",  y: parseInt("{{ $data2['jun'] }}", 10)  },
                { label: "July", y: parseInt("{{ $data2['jul'] }}", 10)  },
                { label: "August", y: parseInt("{{ $data2['aug'] }}", 10)  },
                { label: "September",  y: parseInt("{{ $data2['sep'] }}", 10)  },
                { label: "October",  y: parseInt("{{ $data2['oct'] }}", 10)  },
                { label: "November",  y: parseInt("{{ $data2['nov'] }}", 10)  },
                { label: "December", y: parseInt("{{ $data2['dec'] }}", 10)  },
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
        <h4 class="text-center mark font-weight-bold display-5 bg-warning mb-4">Sales Report in Philippine Currency (PHP)</h4>    
        <div class="row">
            
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div id="dailyChart" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div id="weeklyChart" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div id="monthlyChart" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
@endsection