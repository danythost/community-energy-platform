@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('status') }}
    </div>
@endif
@if ($errors->has('report'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ $errors->first('report') }}
    </div>
@endif



<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="text-sm text-red-600 mb-4">
        Logout
    </button>
</form>

<div class="bg-blue-50 p-4 rounded shadow mb-4">
    <h2 class="font-semibold text-lg text-blue-900">Welcome, {{ Auth::user()->name }}</h2>
    <p class="text-blue-700">{{ Auth::user()->email }}</p>
</div>

<div class="space-y-4">

    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold text-lg">Power Status</h2>
        @if ($powerStatus === 'on')
        <p class="text-green-600 mt-2">Power is ON</p>
        @elseif ($powerStatus === 'off')
            <p class="text-red-600 mt-2">Power is OFF</p>
        @else
            <p class="text-gray-600 mt-2">Power status unknown</p>
        @endif

    </div>

     <div class="grid grid-cols-3 gap-2">

        <!-- Report ON -->
        <form method="POST" action="{{ route('energy.report') }}">
            @csrf
            <input type="hidden" name="type" value="on">
            <button class="w-full bg-green-500 text-white py-3 rounded-lg">
                ON
            </button>
        </form>

        <!-- Report OFF -->
        <form method="POST" action="{{ route('energy.report') }}">
            @csrf
            <input type="hidden" name="type" value="off">
            <button class="w-full bg-red-500 text-white py-3 rounded-lg">
                OFF
            </button>
        </form>

        <!-- Report PROBLEM -->
        <button
            x-data
            @click="$dispatch('open-problem')"
            class="w-full bg-yellow-500 text-white py-3 rounded-lg">
            Problem
        </button>

    </div>

<div
    x-data="{ open: false }"
    @open-problem.window="open = true"
>

    <div
        x-show="open"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
        x-transition
    >
        <div class="bg-white p-6 rounded-lg w-11/12 max-w-md">
            <h3 class="text-lg font-semibold mb-3">
                Report a problem
            </h3>

            <form method="POST" action="{{ route('energy.report') }}">
                @csrf
                <input type="hidden" name="type" value="problem">

                <textarea
                    name="description"
                    required
                    placeholder="Describe the issue..."
                    class="w-full border rounded p-3 mb-4"
                ></textarea>

                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="flex-1 bg-yellow-500 text-white py-2 rounded">
                        Submit
                    </button>

                    <button
                        type="button"
                        @click="open = false"
                        class="flex-1 bg-gray-300 py-2 rounded">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold">My Tokens</h2>
        <p class="text-sm text-gray-600">Power Access: 0</p>
        <p class="text-sm text-gray-600">Steward: 0</p>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold text-lg mb-3">Recent Activity</h2>
        <div class="space-y-3">
            @forelse($events as $event)
                <div class="flex items-center justify-between border-b pb-2 last:border-0 last:pb-0">
                    <div>
                        <div class="font-medium">
                            @if($event->type === 'on')
                                <span class="text-green-600">ON</span>
                            @elseif($event->type === 'off')
                                <span class="text-red-600">OFF</span>
                            @else
                                <span class="text-yellow-600">Problem</span>
                            @endif
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $event->created_at->diffForHumans() }}
                        </div>
                         @if($event->description)
                            <div class="text-sm text-gray-700 mt-1">
                                {{ $event->description }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No recent activity.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
