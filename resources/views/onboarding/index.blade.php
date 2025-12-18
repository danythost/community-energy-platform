@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto py-12">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-blue-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Complete Your Setup</h1>
            <p class="text-blue-100 mt-1">Please select your role and location to continue.</p>
        </div>
        
        <div class="p-8">
            <form method="POST" action="{{ route('onboarding.store') }}" class="space-y-6">
                @csrf

                <!-- Role Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Select your role
                    </label>
                    <div class="relative">
                        <select name="role" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 bg-gray-50 text-gray-900 border appearance-none cursor-pointer">
                            <option value="">-- Choose role --</option>
                            <option value="household">Household</option>
                            <option value="shop_owner">Shop Owner</option>
                            <option value="technician">Technician</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                           <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Your role helps us customize your dashboard.</p>
                </div>

                <!-- Zone Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Select your area / zone
                    </label>
                    <div class="relative">
                        <select name="zone_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 bg-gray-50 text-gray-900 border appearance-none cursor-pointer">
                            <option value="">-- Choose zone --</option>
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}">
                                    {{ $zone->name }}
                                </option>
                            @endforeach
                        </select>
                         <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                           <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow transition duration-150 ease-in-out transform hover:-translate-y-0.5"
                    >
                        Continue to Dashboard
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
