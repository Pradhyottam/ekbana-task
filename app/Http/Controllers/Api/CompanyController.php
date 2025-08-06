<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('category')->paginate(10);
        return response()->json($companies);
    }

    public function show($id)
    {
        $company = Company::with('category')->findOrFail($id);
        return response()->json($company);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'category_id' => 'nullable|exists:company_categories,id',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('companies', 'public');
        }

        $company = Company::create($validated);

        return response()->json($company, 201);
    }

    // 4. Update company
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'category_id' => 'nullable|exists:company_categories,id',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            if ($company->image && Storage::disk('public')->exists($company->image)) {
                Storage::disk('public')->delete($company->image);
            }

            $validated['image'] = $request->file('image')->store('companies', 'public');
        }

        $company->update($validated);

        return response()->json($company);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        if ($company->image && Storage::disk('public')->exists($company->image)) {
            Storage::disk('public')->delete($company->image);
        }

        $company->delete();

        return response()->json(['message' => 'Company deleted']);
    }
}
