<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ServiceCategory::where('office_id', $this->currentOfficeId())
            ->orderBy('name')
            ->get();

        return view('service-categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ServiceCategory::create([
            'office_id' => $this->currentOfficeId(),
            'name' => $validated['name'],
        ]);

        return redirect()
            ->route('service-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(int $id): View
    {
        $category = $this->categoryForCurrentOffice($id);

        return view('service-categories.edit', compact('category'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = $this->categoryForCurrentOffice($id);
        $category->update([
            'name' => $validated['name'],
        ]);

        return redirect()
            ->route('service-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = $this->categoryForCurrentOffice($id);
        $category->delete();

        return redirect()
            ->route('service-categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    private function categoryForCurrentOffice(int $id): ServiceCategory
    {
        return ServiceCategory::where('office_id', $this->currentOfficeId())->findOrFail($id);
    }

    private function currentOfficeId(): int
    {
        $user = auth()->user();
        $officeId = $user?->office_id;

        abort_unless($user && $user->role === 'office', 403, 'Only office users can access this area.');
        abort_unless($officeId, 403, 'Your account is not linked to an office.');

        return (int) $officeId;
    }
}
