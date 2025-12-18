@extends('layouts.app')

@section('content')
<div class="space-y-4">

    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold text-lg">Power Status</h2>
        <p class="text-green-600 mt-2">Power is ON</p>
    </div>

    <div class="grid grid-cols-2 gap-2">
        <button class="bg-green-500 text-white py-3 rounded-lg">
            Report ON
        </button>
        <button class="bg-red-500 text-white py-3 rounded-lg">
            Report OFF
        </button>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold">My Tokens</h2>
        <p class="text-sm text-gray-600">Power Access: 0</p>
        <p class="text-sm text-gray-600">Steward: 0</p>
    </div>

</div>
@endsection
