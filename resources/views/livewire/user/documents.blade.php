<div class="p-8 text-center">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">User Dashboard</h2>

    @if ($isAdmin)
        <div class="bg-green-100 text-green-800 p-4 rounded-lg">
            <strong>You’re now an Admin 💚</strong>
        </div>

    @elseif ($alreadyRequested)
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg">
            <strong>Your request is pending approval 🌿</strong>
        </div>

    @else
        <button
            wire:click="sendRequest"
            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
            💼 Make me Admin
        </button>
    @endif

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">{{ session('message') }}</div>
    @endif
</div>
