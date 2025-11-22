@extends('layouts.admin')

@section('title', 'Category')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Categories</h2>
    <a href="{{ route('admin.categories.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        + Add Category
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">

    <table class="min-w-full table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">Image</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">Name</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y">

            @foreach ($categories as $category)
            <tr>
                <td class="px-6 py-4">
                    {{-- Preview Hover --}}
                    <div class="relative group w-12 h-12">
                        <img src="{{ asset('image_category/' . $category->image) }}" 
                             class="w-12 h-12 object-cover border rounded cursor-pointer">

                        <div class="hidden group-hover:flex absolute -right-48 top-1/2 -translate-y-1/2 
                                    w-40 h-40 bg-white shadow-xl border rounded-lg p-2 z-50">
                            <img src="{{ asset('image_category/' . $category->image) }}" 
                                 class="w-full h-full object-cover rounded-md">
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4 text-gray-800 font-medium">
                    {{ $category->name }}
                </td>

                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">

                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                           class="text-blue-600 hover:underline">Edit</a>

                        <form method="POST" 
                              action="{{ route('admin.categories.destroy', $category->id) }}"
                              onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>

                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>

@endsection
