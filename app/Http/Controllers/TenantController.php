<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Rent;
use App\Models\Shop;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\MezzanineFloor;
use Barryvdh\DomPDF\Facade\Pdf;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Tenant::with(['flats', 'shops', 'mezzanines', 'rents']);

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('tenant_name', 'like', '%' . $search . '%')
              ->orWhere('father_name', 'like', '%' . $search . '%')
              ->orWhere('phone_number', 'like', '%' . $search . '%');
    }

    $tenants = $query->paginate(5); // Adjust the number of items per page as needed

    return view('tenants.index', compact('tenants'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flats = Flat::all();
        $shops = Shop::all();
        $mezzanines = MezzanineFloor::all();
        return view('tenants.create', compact('flats', 'shops', 'mezzanines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tenant_name' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            // 'cnic_number' => 'required|string|regex:/^\d{5}-\d{7}-\d{1}$/|max:15|unique:tenants,cnic_number',
            'phone_number' => 'required|string|regex:/^03\d{9}$/|max:11|unique:tenants,phone_number',
            'rent_start_date' => 'required|date',
            'rent_end_date' => 'required|date',
            'residence_type' => 'required|string',
            'residence_id' => 'required',
            // 'cnic_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Prepare data for tenant creation
        $data = $request->only([
            'tenant_name',
            'father_name',
            'cnic_number',
            'phone_number',
            'rent_start_date',
            'rent_end_date',
            'residence_type',
            'residence_id',
        ]);
    
       
    // Handle CNIC image upload
    if ($request->hasFile('cnic_image')) {
        $file = $request->file('cnic_image');
        $filename = time() . '_cnic.' . $file->getClientOriginalExtension();
        $path = 'assets/uploads/cnic_images/';
        if ($file->move(public_path($path), $filename)) {
            $data['cnic_image'] = $path . $filename;
        } else {
            return back()->with('error', 'Failed to upload CNIC image.');
        }
    }

    // Handle tenant picture upload
    if ($request->hasFile('picture')) {
        $file = $request->file('picture');
        $filename = time() . '_picture.' . $file->getClientOriginalExtension();
        $path = 'assets/uploads/pictures/';
        if ($file->move(public_path($path), $filename)) {
            $data['picture'] = $path . $filename;
        } else {
            return back()->with('error', 'Failed to upload tenant picture.');
        }
    }

    
        // Add home and residence values
        $data['home'] = $request->input('residence_type');
        $data['residence'] = $request->input('residence_id');
    
        // Create the tenant
        $tenant = Tenant::create($data);
    
        // Update tenant_id for the corresponding residence type
        if ($request->residence_type == 'flat') {
            Flat::where('flat_number', $request->residence_id)->update(['tenant_id' => $tenant->id]);
        } elseif ($request->residence_type == 'shop') {
            Shop::where('shop_number', $request->residence_id)->update(['tenant_id' => $tenant->id]);
        } elseif ($request->residence_type == 'mezzanine') {
            MezzanineFloor::where('mezzanine_number', $request->residence_id)->update(['tenant_id' => $tenant->id]);
        }
    
        return redirect()->route('tenants.index')->with('success', 'Tenant added successfully.');
    }
    
    
    public function payRent(Request $request, $tenantId)
    {
        $request->validate([
            'rent_for_month' => 'required|numeric',
            'month' => 'required|string|max:20',
            'date' => 'required|date',
            'paid_rent' => 'required|boolean',
        ]);

        Rent::create([
            'tenant_id' => $tenantId,
            'rent_for_month' => $request->rent_for_month,
            'month' => $request->month,
            'date' => $request->date,
            'paid_rent' => $request->paid_rent,
        ]);

        return redirect()->route('tenants.index')
            ->with('success', 'Rent payment recorded successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tenant = Tenant::with(['flats', 'shops', 'mezzanines', 'rents'])->findOrFail($id);
        return view('tenants.show', compact('tenant'));
    }
    public function showDetails($id)
    {
        // Fetch the tenant by ID or fail if not found
        $tenant = Tenant::findOrFail($id);

        // Return the view with the tenant data
        return view('tenants.form', compact('tenant'));
    }
    public function generatePDF($id)
    {
        // Fetch the tenant by ID or fail if not found
        $tenant = Tenant::findOrFail($id);
    
        // Share data to view
        $data = compact('tenant');
    
        // Load view and pass the tenant data to it
        $pdf = Pdf::loadView('tenants.form', $data);
    
        // Download the PDF file
        return $pdf->download('tenant_details.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        // Validate the incoming request
        $request->validate([
            'tenant_name' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            // 'cnic_number' => 'required|string|regex:/^\d{5}-\d{7}-\d{1}$/|max:15',
            'phone_number' => 'required|string|regex:/^03\d{9}$/|max:11',
            'rent_start_date' => 'required|date',
            'rent_end_date' => 'required|date',
         
            // 'cnic_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Prepare data for updating tenant
        $data = $request->only([
            'tenant_name',
            'father_name',
            'cnic_number',
            'phone_number',
            'rent_start_date',
            'rent_end_date',
       
        ]);
    
     // Handle CNIC image upload
     if ($request->hasFile('cnic_image')) {
        $file = $request->file('cnic_image');
        $filename = time() . '_cnic.' . $file->getClientOriginalExtension();
        $path = 'assets/uploads/cnic_images/';
        if ($file->move(public_path($path), $filename)) {
            $data['cnic_image'] = $path . $filename;
        } else {
            return back()->with('error', 'Failed to upload CNIC image.');
        }
    }

    // Handle tenant picture upload
    if ($request->hasFile('picture')) {
        $file = $request->file('picture');
        $filename = time() . '_picture.' . $file->getClientOriginalExtension();
        $path = 'assets/uploads/pictures/';
        if ($file->move(public_path($path), $filename)) {
            $data['picture'] = $path . $filename;
        } else {
            return back()->with('error', 'Failed to upload tenant picture.');
        }
    }
        // Update tenant data
        $tenant->update($data);
    
        // Update tenant_id for the corresponding residence type
        if ($request->residence_type == 'flat') {
            Flat::where('flat_number', $request->residence_id)->update(['tenant_id' => $tenant->id]);
        } elseif ($request->residence_type == 'shop') {
            Shop::where('shop_number', $request->residence_id)->update(['tenant_id' => $tenant->id]);
        } elseif ($request->residence_type == 'mezzanine') {
            MezzanineFloor::where('mezzanine_number', $request->residence_id)->update(['tenant_id' => $tenant->id]);
        }
    
        // Redirect back to the tenant's show page with success message
        return redirect()->route('tenants.show', ['tenant' => $tenant->id])
                         ->with('success', 'Tenant updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();
    
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully');
    }
   
    
    // TenantController.php

public function search(Request $request)
{
    // Initialize the query builder for the Rent model
    $query = Rent::query();
    
    // Apply search criteria if they exist
    if ($request->has('query')) {
        $search = $request->input('query');
        $query->where(function ($q) use ($search) {
            $q->where('month', 'like', '%' . $search . '%')
              ->orWhere('multiple_month', 'like', '%' . $search . '%')
              ->orWhere('year', 'like', '%' . $search . '%');
        });
    }
    
    // Optionally filter by tenant if tenant_id is provided
    if ($request->has('tenant_id')) {
        $tenantId = $request->input('tenant_id');
        $query->where('tenant_id', $tenantId);
    }
    
    // Paginate the results
    $rents = $query; // Adjust the number of items per page as needed
    
    return view('tenants.show', compact('rents'));
}

}
