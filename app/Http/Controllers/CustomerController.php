<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ALL CUSTOMERS - INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $search = $request->input('search');

        $customers = Customer::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('address', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('customers.index', compact('customers'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADD CUSTOMER PAGE - CREATE
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        return view('customers.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE NEW CUSTOMER - STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer added successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT CUSTOMER PAGE
    |--------------------------------------------------------------------------
    */

    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Customer $customer
    ): RedirectResponse {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully!');
    }
}
