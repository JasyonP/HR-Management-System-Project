<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    
    <nav class="sidebar">
        <header>
            <div class="image-text">
                <div class="text-logo-text">
                    <span class="name">Human Resources Management System</span>
                </div>
            </div>
        </header>

        <div class="menu-bar">
            <div class="menu">

              <div class="profileclass">
                    <img src="{{ asset('img/profile.png') }}" alt="" class="profilepic">
               </div>

              <h4 class="staffname">{{$user->first_name}} {{$user->last_name}} </h4>
              <p class="title" style="text-transform:uppercase;">{{$user->title}}</p>

              <hr class="sidebar-divider" style="width: 100%; border-color: white;">

                    <li class="nav-link">
                      <a class="nav-link active" href="{{ route('staff.dashboard') }}">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a class="nav-link active" href="{{ route('dashboard.ranking') }}" >
                            <i class='bx bxs-medal icon'></i>
                              <span class="text nav-text">Ranking</span>
                          </a>
                      </li>

                    <li class="nav-link">
                      <a class="nav-link active" href="{{ route('dashboard.employees') }}" >
                        <i class='bx bxs-user icon' ></i>
                            <span class="text nav-text">Employees</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a class="nav-link active" href="{{ route('dashboard.job-dept') }}">
                            <i class='bx bxs-briefcase-alt-2 icon'></i>
                              <span class="text nav-text">Job & Department</span>
                          </a>
                      </li>
                    
                    <hr class="sidebar-divider" style="width: 100%; border-color: white;">

                    <li class="nav-link">
                      <a class="nav-link active" href="#logout" onclick="handleLogout(event)">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                        <form id="logoutForm" action="{{ route('logout') }}" method="post" style="display: none;">
                            @csrf
                        </form>
                      </a>
                    </li>
            </div>

    </nav>

    <script src="{{ asset('staff/js/staff_page.js') }}"></script>
</body>
</html>