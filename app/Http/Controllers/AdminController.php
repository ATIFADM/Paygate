<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;

class AdminController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('user')->latest()->get();
        $usersWithStats = \App\Models\User::where('role', '!=', 'admin')
            ->withCount('invoices')
            ->orderByDesc('invoices_count')
            ->take(4)
            ->get();

        return view('admin.index', compact('invoices', 'usersWithStats'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return back()->with('success', 'Invoice deleted successfully.');
    }
}
