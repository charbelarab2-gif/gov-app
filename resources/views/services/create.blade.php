{{-- Include navigation menu --}}
@include('office.partials.nav')
<h1>Add Service</h1>
{{-- Display validation errors --}}
@if ($errors->any())
<div style="color: red;">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li> {{-- Show each error --}}
@endforeach
</ul>
</div>
@endif
{{-- If no categories exist --}}
@if ($categories->isEmpty())
<p>You need to create a category before adding a service.</p>
{{-- Link to categories page --}}
<a href="{{ route('service-categories.index') }}">
Go to Categories
</a>
@else
{{-- Service creation form --}}
<form method="POST" action="{{ route('services.store') }}">
@csrf 
{{-- Category dropdown --}}
<label>Category</label><br>
<select name="service_category_id" required>
<option value="">Select Category</option>
{{-- Loop categories --}}
@foreach ($categories as $category)
<option value="{{ $category->id }}"
@selected(old('service_category_id') == $category->id)>
{{ $category->name }}
</option>
@endforeach
</select>
<br><br>
{{-- Service name --}}
<label>Name</label><br>
<input type="text" name="name" value="{{ old('name') }}" required>
<br><br>
{{-- Description --}}
<label>Description</label><br>
<textarea name="description">{{ old('description') }}</textarea>
<br><br>
{{-- Fee --}}
<label>Fee</label><br>
<input type="number" step="0.01" name="fee" value="{{ old('fee') }}">
<br><br>
{{-- Duration --}}
<label>Duration (minutes)</label><br>
<input type="number" name="duration" value="{{ old('duration') }}">
<br><br>
{{-- Required documents --}}
<label>Required Documents</label><br>
<textarea name="required_documents">
{{ old('required_documents') }}
</textarea>
<br><br>
{{-- Submit button --}}
<button type="submit">Save</button>
</form>
@endif