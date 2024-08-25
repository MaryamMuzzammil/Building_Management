<!DOCTYPE html>
<html>
<head>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
        }
        .tenant-details {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid black;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Info Container Styling */
        .info-container {
            display: flex;
            width: 100%;
            margin-bottom: 20px;
        }

        /* Tenant Information Styling */
        .tenant-info {
            float: left;
            margin-right: 20px;
            width: 50%;
        }

        .tenant-info h1 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #000;
        }

        .tenant-info p {
            margin: 20px 0;
            font-size: 16px;
            color: #333;
            
         
        
        }

        /* Profile Picture Styling */
        .profile-picture {
            flex: 1;
            text-align: center;
        }

        .profile-picture img {
            width: 50%;
            max-width: 150px;
            max-height: 150px;
           float: right;
        }

        /* CNIC Image Styling */
        .cnic-image {
            text-align: center;
            margin-top: 200px;
        }

        .cnic-image img {
            width: 100%;
            max-width: 300px;
            height: auto;
            
        }
    </style>

</head>
<body>
    <div class="tenant-details">
        <div class="info-container">
            <div class="tenant-info">
                <u><h1 style="text-transform: capitalize;">{{ $tenant->tenant_name }} {{ $tenant->father_name }}</h1></u>
                <h1 style="text-transform: capitalize;"><strong>Rental In:</strong> {{ $tenant->home }} # {{ $tenant->residence }}</h1>
                <p style="text-transform: capitalize;"><strong>Tenant Name:</strong> {{ $tenant->tenant_name }}</p>
                <p style="text-transform: capitalize;"><strong>Father's Name:</strong> {{ $tenant->father_name }}</p>
                <p style="text-transform: capitalize;"><strong>CNIC Number:</strong> {{ $tenant->cnic_number }}</p>
                <p style="text-transform: capitalize;"><strong>Phone Number:</strong> {{ $tenant->phone_number }}</p>
                <p style="text-transform: capitalize;"><strong>Tenant Start Date:</strong> {{ $tenant->rent_start_date }}</p>
                <p style="text-transform: capitalize;"><strong>Tenant End Date:</strong> {{ $tenant->rent_end_date }}</p>
            </div>
            <div class="profile-picture">
                <img src="{{ public_path($tenant->picture) }}" alt="Profile Picture">
            </div>
        </div>
        <div class="cnic-image">
            <img src="{{ public_path($tenant->cnic_image) }}" alt="CNIC Image">
        </div>
    </div>
</body>
</html>
