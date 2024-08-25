<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Flat;
use App\Models\Rent;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RentController extends Controller
{
    public function create($tenantId)
    {
        $tenant = Tenant::findOrFail($tenantId);
        
        return view('rents.create', compact('tenant'));
    }

    public function store(Request $request, $tenantId)
    {
        $request->validate([
            'start_month' => 'required|string|in:January,February,March,April,May,June,July,August,September,October,November,December',
            'end_month' => 'required|string|in:January,February,March,April,May,June,July,August,September,October,November,December',
            'year' => 'required|integer',
            'date' => 'required|date',
            'rent_for_month' => 'required|numeric',
            'paid_rent' => 'required|boolean',
            'total_month' => 'required|integer',
            'government_taxes' => 'required|numeric',
        ]);
        
    
        // Fetch the tenant
        $tenant = Tenant::findOrFail($tenantId);
    
        // Fetch the flat associated with the tenant
        $flat = $tenant->flats->first();
        $totalRooms = $flat ? $flat->total_rooms : 1; // Default to 1 if no flat found
    
        // Generate the list of months within the range
        $months = $this->generateMonthsRange($request->start_month, $request->end_month);
        // Create the `multiple_month` string
           // Determine the `multiple_month` value
    
        $multiple_month = $request->start_month === $request->end_month 
        ? $request->start_month 
        : $request->start_month . '-' . $request->end_month;

        // Check for existing rents and create new records
        foreach ($months as $month) {
            // Check if rent record for the same month and year already exists
            $existingRent = Rent::where('tenant_id', $tenantId)
                                ->where('month', $month)
                                ->where('year', $request->year)
                                ->first();
    
            if ($existingRent) {
                return redirect()->back()->withErrors(['months' => 'Rent for one of these months and year is already paid.']);
            }
    
            // Calculate the total amount
           
         // Calculate the total rent amount (rent per month multiplied by total months)
         $total = $totalRooms * $request->rent_for_month;
         $total_amount = $total * intval($request->total_month);
         $additional_costs =   $totalRooms* $request->government_taxes*$request->total_month;
         $all_total = $total_amount + $additional_costs;
         

        //  dd([
        //      'total' => $total,
        //      'total_amount' => $total_amount,
        //      'additional_costs' => $additional_costs,
        //      'all_total' => $all_total
        //  ]);
    

            // Create a rent record for each month
            $tenant->rents()->create([
                'month' => $month,
                'year' => $request->year,
                'date' => $request->date,
                'rent_for_month' => $request->rent_for_month,
                'paid_rent' => $request->paid_rent,
                'total_month' => $request->total_month,
                'total_amount' => $total_amount,
                'multiple_month' => $multiple_month,
                'government_taxes' => $request->government_taxes,
                'all_total' => $all_total
            ]);
        }
    
        // Redirect with success message
        return redirect()->route('tenants.show', ['tenant' => $tenantId])
                         ->with('success', 'Rent payments added successfully.');
    }
    
    protected function generateMonthsRange($startMonth, $endMonth)
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $startIndex = array_search($startMonth, $months);
        $endIndex = array_search($endMonth, $months);
    
        if ($startIndex === false || $endIndex === false || $startIndex > $endIndex) {
            return [];
        }
    
        return array_slice($months, $startIndex, $endIndex - $startIndex + 1);
    }
    

    


    public function show($id)
    {
        $rent = Rent::with('tenant.flats')->findOrFail($id);
        
        return view('rents.show', compact('rent'));
    }

    public function edit($id)
    {
        $rent = Rent::findOrFail($id);
        return view('rents.edit', compact('rent'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'year' => 'required|integer',
            'start_month' => 'required|string|in:January,February,March,April,May,June,July,August,September,October,November,December',
            'end_month' => 'required|string|in:January,February,March,April,May,June,July,August,September,October,November,December',
            'date' => 'required|date',
            'rent_for_month' => 'required|numeric',
            'paid_rent' => 'required|boolean',
            'total_month' => 'required|integer',
            'government_taxes' => 'required|numeric',
        ]);
        
        // Generate the list of months between start and end months
        $months = $this->generateMonthsRange($request->start_month, $request->end_month);
        
        // Determine the `multiple_month` value
        $multiple_month = $request->start_month === $request->end_month 
            ? $request->start_month 
            : $request->start_month . '-' . $request->end_month;
        
        // Find the existing rent record to update
        $rent = Rent::findOrFail($id);
    
        // Check for existing rents for the new month range, excluding the current record
        foreach ($months as $month) {
            $existingRent = Rent::where('tenant_id', $rent->tenant_id)
                                ->where('month', $month)
                                ->where('year', $request->year)
                                ->where('id', '!=', $id) // Exclude the current record being updated
                                ->first();
            
            if ($existingRent) {
                return redirect()->back()->withErrors(['months' => 'Rent for one of these months and year is already paid.']);
            }
        }
    
        // Find the tenant and associated flat
        $tenant = Tenant::findOrFail($rent->tenant_id);
        $flat = $tenant->flats->first();
        $totalRooms = $flat ? $flat->total_rooms : 1; // Default to 1 if no flat found
    
        // Calculate the total rent amount and additional costs
        $totalRentPerMonth = $totalRooms * $request->rent_for_month;
        $totalAmount = $totalRentPerMonth * $request->total_month;
        $additionalCosts = $totalRooms * $request->government_taxes * $request->total_month;
        $allTotal = $totalAmount + $additionalCosts;
    
        // Update the rent record with new data
        $rent->update([
            'year' => $request->year,
            'start_month' => $request->start_month,
            'end_month' => $request->end_month,
            'date' => $request->date,
            'rent_for_month' => $request->rent_for_month,
            'paid_rent' => $request->paid_rent,
            'total_month' => $request->total_month,
            'government_taxes' => $request->government_taxes,
            'multiple_month' => $multiple_month,
            'total_amount' => $totalAmount, // Assuming you have a field for total_amount
            'additional_costs' => $additionalCosts, // Assuming you have a field for additional_costs
            'all_total' => $allTotal, // Assuming you have a field for all_total
        ]);
    
        // Redirect back to the tenant's show page with success message
        return redirect()->route('tenants.show', ['tenant' => $rent->tenant_id])
                         ->with('success', 'Rent payment updated successfully.');
    }
    
    
    
    
    public function convertNumberToWords($number)
    {
        $number = intval($number); // Convert the number to an integer to ignore the decimal part

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ' ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = [
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'forty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        ];

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convertNumberToWords only accepts numbers between ' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convertNumberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convertNumberToWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convertNumberToWords($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = [];
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }



    public function receipt($id)
    {
        \Log::info('PDF generation started');
        set_time_limit(300); // Increase time limit to 5 minutes
    
        $rent = Rent::with('tenant.flats')->findOrFail($id); // Ensure tenant flats are loaded
        \Log::info('Rent record fetched');
    
        $tenant = $rent->tenant;
        $flat = $tenant->flats->first();
        $totalRooms = $flat ? $flat->total_rooms : 1; // Fetch total_rooms or default to 'N/A' if not found
    
          // Convert total_amount to words
          $amountInWords = $this->convertNumberToWords($rent->total_amount);

        $pdf = PDF::loadView('rents.receipt', compact('rent', 'totalRooms','amountInWords'));
        \Log::info('PDF loaded');
    
        return $pdf->download('receipt-' . $rent->id . '.pdf');
    }
    public function destroy($id)
    {
        // Find the rent record by ID
        $rent = Rent::findOrFail($id);

        // Store the tenant ID for redirection
        $tenantId = $rent->tenant_id;

        // Delete the rent record
        $rent->delete();

        // Redirect to the tenant's details page with a success message
        return redirect()->route('tenants.show', ['tenant' => $tenantId])
                         ->with('success', 'Rent payment deleted successfully.');
    }
  // RentController.php
// RentController.php
public function search(Request $request, $tenantId)
{
    $tenant = Tenant::findOrFail($tenantId);
    $query = $request->input('search');

    // Get all rents for the tenant
    $rents = $tenant->rents;

    // Filter rents based on the search query
    $sortedRents = $rents->sortByDesc('id');
    $uniqueRents = $sortedRents->unique(function ($item) {
        return $item->month . '-' . $item->year;
    });

    if ($query) {
        $filteredRents = $uniqueRents->filter(function ($rent) use ($query) {
            return stripos($rent->month, $query) !== false ||
                   stripos($rent->date, $query) !== false;
        });
    } else {
        $filteredRents = $uniqueRents;
    }

    return view('tenants.rents_table', ['rents' => $filteredRents, 'tenant' => $tenant]);
}







   
}
