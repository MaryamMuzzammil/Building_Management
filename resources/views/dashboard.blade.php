@extends('adminlayout.app')

@section('content')
<style>

</style>
<br><br>
<div class="pagetitle">
    <h1><center>Welcome  </center></h1>
   
</div><br>
<br>
<section class="section dashboard">
    <div class="row">
        <!-- Card: Total Tenants -->
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Tenants
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTenants }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300" style="color: #e18906;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Total Floors -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Shops
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalFloors }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300" style="color: #e18906;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Total Flats -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2" >
                <div class="card-body"  >
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Flats
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalFlats }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-gray-300" style="color: #e18906;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Total Rent -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Total Rent
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalRent, 2) }} PKR</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300" style="color: #e18906;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Current Time -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Current Time
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="current-time">{{ now()->format('h:i:s A') }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clock fa-2x text-gray-300" style="color: #e18906;"></i> <!-- Clock icon -->
                </div>
            </div>
        </div>
    </div>
</div>
         <!-- Card: Current date -->
         <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Current Date
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="current-time">{{ now()->format('d M Y') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300" style="color: #e18906;"></i> <!-- Correct calendar icon -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<br><br><br><br><br>

@section('scripts')
<script>
    function updateTime() {
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        document.getElementById('current-time').textContent = strTime;
    }
    
    function updateDate() {
        var now = new Date();
        var day = now.getDate().toString().padStart(2, '0');
        var month = now.getMonth() + 1; // January is 0!
        var year = now.getFullYear();
        var strDate = day + ' ' + month + ' ' + year;
        document.getElementById('current-date').textContent = strDate;
    }

    setInterval(updateTime, 1000);
    updateTime(); // Initialize the time on page load
    updateDate(); // Initialize the date on page load
</script>
@endsection


@endsection
