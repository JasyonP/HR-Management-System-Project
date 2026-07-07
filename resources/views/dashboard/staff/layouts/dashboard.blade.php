<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Dashboard</title>

    <link rel="stylesheet" href="{{ asset('staff/staff_page.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>

        .box-1 {
        background-color: rgba(52, 95, 173);
        }

        .box-2 {
        background-color: rgba(52, 95, 173);
        }

    </style>

    <!-- Include CSS and JS assets -->
</head>

        @include('dashboard/staff/layouts/sidebar')

        <section class="home">
            {{-- DASHBOARD --}}
                <div>
                    @unless (trim($__env->yieldContent('content')))
                        <h1 class="h1-page mb-3">Dashboard</h1>

                        <div class="row mb-2" style="height: 400px;">
                            <div class="col-md-12 d-flex flex-row h-100 w-100">
                              <div class="box-1 text-white me-2 p-3" style="flex: 1;">
                                <h3>Workload</h3>
                                <div id="donutchart" style="width: 770px; height: 330px;"></div>
                              </div>
                              <div class="box-2 text-white p-3" style="flex: 1;">
                                <h3>Employment Status</h3>
                                <div id="piechart_3d" style="width: 770px; height: 330px;"></div>
                              </div>
                            </div>
                          </div>
                          
                        <div id="piechart" style="width: 1610px; height: 500px;"></div>
                    @endunless

                    
                </div>
                
        
            {{-- CONTENT PAGES --}}
                <div class="main-content">
                    @yield('content')
                </div>
        </section>
    </body>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
    
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Department');
        data.addColumn('number', 'Employees');
    
        @foreach ($employeeCounts as $department)
          data.addRow([ '{{ $department->department_name }}', {{ $department->employees_count }}]);
        @endforeach
    
        var options = {
          title: 'Employees'
        };
    
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Full Time',     {{$fullTimeCount}}],
            ['Part Time',      {{$partTimeCount}}],
          ]);
  
          var options = {
            title: 'Work Status',
            pieHole: 0.4,
          };
  
          var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
          chart.draw(data, options);
        }
      </script>

    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Active',     {{$active}}],
            ['Retired',      {{$retired}}],

        ]);

        var options = {
            title: 'Employment Status',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
        }
    </script>
    
</html>
