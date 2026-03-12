<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::with('category')
            ->where('office_id', $this->currentOfficeId())
            ->orderBy('name')
            ->get();

        return view('services.index', compact('services'));
    }

    public function create(): View
    {
        $categories = $this->categoriesForCurrentOffice();

        return view('services.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fee' => 'required|numeric',
            'duration' => 'nullable|integer|min:0',
            'required_documents' => 'nullable|string',
        ]);

        $category = $this->categoryForCurrentOffice((int) $validated['service_category_id']);

        Service::create([
            'office_id' => $this->currentOfficeId(),
            'service_category_id' => $category->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'fee' => $validated['fee'],
            'duration' => $validated['duration'] ?? null,
            'required_documents' => $validated['required_documents'] ?? null,
            'is_active' => true,
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(int $id): View
    {
        $service = Service::where('office_id', $this->currentOfficeId())->findOrFail($id);
        $categories = $this->categoriesForCurrentOffice();

        return view('services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'service_category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fee' => 'required|numeric',
            'duration' => 'nullable|integer|min:0',
            'required_documents' => 'nullable|string',
        ]);

        $service = Service::where('office_id', $this->currentOfficeId())->findOrFail($id);
        $category = $this->categoryForCurrentOffice((int) $validated['service_category_id']);

        $service->update([
            'service_category_id' => $category->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'fee' => $validated['fee'],
            'duration' => $validated['duration'] ?? null,
            'required_documents' => $validated['required_documents'] ?? null,
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $service = Service::where('office_id', $this->currentOfficeId())->findOrFail($id);
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }

    private function categoriesForCurrentOffice()
    {
        return ServiceCategory::where('office_id', $this->currentOfficeId())
            ->orderBy('name')
            ->get();
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