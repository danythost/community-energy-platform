@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 space-y-6">

    <div class="text-center">
        <h1 class="text-2xl font-bold text-gray-800">
            Energy Commons
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Track power. Access energy. Support your community.
        </p>
    </div>

    {{-- TEMP EMAIL LOGIN (DEV MODE) --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input
            type="email"
            name="email"
            placeholder="Email address"
            required
            class="w-full border rounded-lg p-3 mb-3"
        />

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
            class="w-full border rounded-lg p-3 mb-4"
        />

        <button
            type="submit"
            class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition">
            Continue
        </button>
    </form>

    <p class="text-xs text-center text-gray-400">
        Wallet & phone login coming soon.
    </p>

</div>
@endsection
