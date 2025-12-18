@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gray-800 px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-white">Create New User</h1>
            <a href="{{ route('steward.dashboard') }}" class="text-gray-300 hover:text-white text-sm">
                &larr; Back to Dashboard
            </a>
        </div>
        
        <div class="p-8">
            @if (session('status'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-4 border" value="{{ old('name') }}">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-4 border" value="{{ old('email') }}">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Password (Optional) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password 
                        <span class="text-gray-400 font-normal ml-1">(Optional, defaults to 'password')</span>
                    </label>
                    <input type="password" name="password" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-4 border">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <!-- Role Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select name="role" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-4 border bg-white">
                            <option value="household">Household</option>
                            <option value="shop_owner">Shop Owner</option>
                            <option value="technician">Technician</option>
                            <option value="steward">Steward</option>
                        </select>
                         @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Zone Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Zone</label>
                        <select name="zone_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-4 border bg-white">
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                            @endforeach
                        </select>
                         @error('zone_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-6 border-t">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow transition duration-150">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
