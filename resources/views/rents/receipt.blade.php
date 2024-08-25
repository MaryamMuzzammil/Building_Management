<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .receipt-container {
            padding: 5px;
            border: 1px solid black;
        }

        .receipt-header {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-bottom: 13px;
            border-bottom: 1px solid #000;
        }

        .receipt-header h1 {
            font-family: Arial, sans-serif;
            margin: 0;
            font-size: 18px;
        }

        .receipt-header p {
            margin: 4px 0;
            font-size: 10px;
        }

        .receipt-info2 {
            float: right;
            margin-top: -10%;
            font-size: 12px;
        }

        .receipt-info, .receipt-details, .receipt-summary, .receipt-rupees {
            padding: 8px 0;
        }

        .receipt-info div, .receipt-details div, .receipt-summary div, .receipt-rupees div {
            margin-bottom: 7px;
        }

        .receipt-summary {
            font-weight: bold;
        }

        .signature {
            text-align: right;
            margin-top: 10px;
            margin-right: 20px;
        }

        .s, .s2 {
            margin-right: 8%;
        }

        .note {
            font-size: 10px;
            margin-top: 4px;
            border-top: 1px solid #000;
            padding-top: 8px;
        }

        .tax-section {
            padding: 10px;
            border-top: 1px solid black;
        }

        .tax-section h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>MASHALLAH MANSION</h1>
            <p>L-y7, Plot # 21, Near Shah Abdul Latif Bithahi Hall</p>
            <p>Shah Abdul Latif Bithai Road, Moosa Lane, Karachi.</p>
        </div>
        <div class="receipt-info">
            <div>No. {{ $rent->id }}{{ $rent->year }}</div>
            <div style="text-transform: capitalize;">Rental In: <u>{{ $rent->tenant->home }} # {{ $rent->tenant->residence }}</u></div>
            <div style="text-transform: capitalize;">Mr. / Mrs. / Miss: <u><b>{{ $rent->tenant->tenant_name }} {{ $rent->tenant->father_name }}</b></u></div>
            <div class="receipt-info2">
                <div>Date: {{ $rent->date }}</div>
                <div>No. of Rooms: {{ $totalRooms }}</div>
                <div>Rate: {{ $rent->rent_for_month }} P.M.</div>
            </div>
        </div>
       
        <div class="receipt-details">
            <div>Rent for the Month’s: {{ $rent->multiple_month }} {{ $rent->year }}</div>
        </div>
        <div class="receipt-summary">
            <div>Total Amount: {{ number_format($rent->total_amount, 0) }}</div> 
        </div>
     
        <div class="receipt-rupees">
            <div style="text-transform: capitalize;">Received Rupees: <u>{{ $amountInWords }} Only/=</u></div>
        </div>
        <div class="note">
            <div>N.B.: Terms and conditions overleaf of this receipt.</div>
            <div style="text-align: right; margin-top: -14px;">E. & O. E.</div>
        </div>
        <div class="signature">
            <br>
            <div>__________________________</div>
            <div class="s">Signature</div>
            <div class="s2">Land Lord</div>
        </div>
    </div>
    
    <div class="tax-section">
        <h2>Local Government Taxes</h2>
        <table>
            <thead>
                <tr>
                    <th>Particulars</th>
                    <th>Total Months</th>
                    <th>@ P.M.</th>
                    <th>Total Rooms</th>
                    <th>Total Rs</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rent</td>
                    <td>{{ $rent->total_month }}</td>
                    <td>{{ $rent->government_taxes }}</td>
                    <td>{{ $totalRooms }}</td>
                    <td>{{ $totalRooms * $rent->total_month * $rent->government_taxes }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>MASHALLAH MANSION</h1>
            <p>L-y7, Plot # 21, Near Shah Abdul Latif Bithahi Hall</p>
            <p>Shah Abdul Latif Bithai Road, Moosa Lane, Karachi.</p>
        </div>
        <div class="receipt-info">
            <div>No. {{ $rent->id }}{{ $rent->year }}</div>
            <div style="text-transform: capitalize;">Rental In: <u>{{ $rent->tenant->home }} # {{ $rent->tenant->residence }}</u></div>
            <div style="text-transform: capitalize;">Mr. / Mrs. / Miss: <u><b>{{ $rent->tenant->tenant_name }} {{ $rent->tenant->father_name }}</b></u></div>
            <div class="receipt-info2">
                <div>Date: {{ $rent->date }}</div>
                <div>No. of Rooms: {{ $totalRooms }}</div>
                <div>Rate: {{ $rent->rent_for_month }} P.M.</div>
            </div>
        </div>
       
        <div class="receipt-details">
            <div>Rent for the Month’s: {{ $rent->multiple_month }} {{ $rent->year }}</div>
        </div>
        <div class="receipt-summary">
            <div>Total Amount: {{ number_format($rent->total_amount, 0) }}</div> 
        </div>
     
        <div class="receipt-rupees">
            <div style="text-transform: capitalize;">Received Rupees: <u>{{ $amountInWords }} Only/=</u></div>
        </div>
        <div class="note">
            <div>N.B.: Terms and conditions overleaf of this receipt.</div>
            <div style="text-align: right; margin-top: -14px;">E. & O. E.</div>
        </div>
        <div class="signature">
            <div>__________________________</div>
            <div class="s">Signature</div>
            <div class="s2">Land Lord</div>
        </div>
    </div>
    
    <div class="tax-section">
        <h2>Local Government Taxes</h2>
        <table>
            <thead>
                <tr>
                    <th>Particulars</th>
                    <th>Total Months</th>
                    <th>@ P.M.</th>
                    <th>Total Rooms</th>
                    <th>Total Rs</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rent</td>
                    <td>{{ $rent->total_month }}</td>
                    <td>{{ $rent->government_taxes }}</td>
                    <td>{{ $totalRooms }}</td>
                    <td>{{ $totalRooms * $rent->total_month * $rent->government_taxes }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
