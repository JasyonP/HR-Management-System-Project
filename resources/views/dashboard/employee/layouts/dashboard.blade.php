<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee - Dashboard</title>

    <link rel="stylesheet" href="{{ asset('employees/employee_page.css') }}">
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
</head>
    <body>
    {{-- <div class="loader">
            <div class="jumper">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <script type="text/javascript">
            function hideLoader() {
            var loader = document.querySelector('.loader');
            loader.classList.add('loader--hidden');
            }
            setTimeout(hideLoader, 1000);
        </script> --}}
        @include('dashboard/employee/layouts/sidebar')

        <section class="home">
            {{-- DASHBOARD --}}
                <div>
                    @unless (trim($__env->yieldContent('content')))
                        <h1 class="h1-page mb-2">Dashboard</h1>
                            <div class="row mb-2" style="height: 400px;">
                                <div class="col-md-12 d-flex flex-row h-200 w-100">
                                  <div class="box-1 text-white me-2 p-3" style="flex: 1;">
                                    <h2 class="">Information</h2>
                                        
                                        <table class="table table-transparent table-primary">
                                            <thead>
                                            <tr>
                                                <th colspan="4" class="fs-5">Personal</th> <!-- Top row with border -->
                                            </tr>
                                            <tr>
                                                <th class="fs-6">Name</th>
                                                <th class="fs-6">Date of Birth</th>
                                                <th class="fs-6">Gender</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                            <tr>
                                                <td class="fs-6">{{$user->first_name}} {{$user->last_name}}</td>
                                                <td class="fs-6">{{$user->date_of_birth}}</td>
                                                <td class="fs-6">{{$user->gender}}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <table class="table table-transparent table-primary">
                                            <thead>
                                            <tr>
                                                <th colspan="3" class="fs-5">Contact</th> <!-- Top row with border -->
                                            </tr>
                                            <tr>
                                                <th class="fs-6">Address</th>
                                                <th class="fs-6">Phone #</th>
                                                <th class="fs-6">Email</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                            <tr>
                                                <td class="fs-6">{{$user->address}}</td>
                                                <td class="fs-6">{{$user->phone_number}}</td>
                                                <td class="fs-6">{{$user->email}}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <table class="table table-transparent table-primary">
                                            <thead>
                                            <tr>
                                                <th colspan="4" class="fs-5">Work Info</th> <!-- Top row with border -->
                                            </tr>
                                            <tr>
                                                <th class="fs-6">Work Status</th>
                                                <th class="fs-6">Employment Status</th>
                                                <th class="fs-6">Job Title</th>
                                                <th class="fs-6">Department</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                            <tr>
                                                <td class="fs-6">{{$user->work_status}}</td>
                                                <td class="fs-6">{{$user->employment_status}}</td>
                                                <td class="fs-6">{{$user->job->job_title}}</td>
                                                <td class="fs-6">{{$user->department->department_name}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                  </div>
                                  <div class="box-2 text-white p-3" style="flex: 1;">
                                    <h3>Department Jobs</h3>
                                    <div id="piechart" style="width: 800px; height: 450px;"></div>
                                  </div>
                                </div>
                              </div>
                              
                              <div id="donutchart" style="width: 1610px; height: 500px; margin-top:130px;"></div>
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
      
          @foreach ($employeesByJobId as $item)
            data.addRow([ '{{ $item->job->job_title }}', {{ $item->count }}]);
          @endforeach
      
          var options = {
            title: '{{$user->department->department_name}}'
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
        title: '{{$user->department->department_name}} Full Time & Part Time Employees',
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
      chart.draw(data, options);
    }
  </script>
</html>