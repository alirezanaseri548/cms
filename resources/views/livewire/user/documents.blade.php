<div class="p-6 bg-white rounded shadow-md w-full max-w-lg mx-auto">
    <h2 class="font-bold text-xl mb-4 text-green-600">Role Upgrade Request 💚</h2>

    @if (session()->has('msg'))
        <p class="mb-3 text-blue-600">{{ session('msg') }}</p>
    @endif

    @if($request)
        @if($request->status === 'pending')
            <p class="text-yellow-600">Your request is pending approval 🌿</p>
        @elseif($request->status === 'approved')
            <p class="text-green-600">You are now an Admin ✅</p>
        @else
            <p class="text-red-600">Your request was rejected ❌</p>
        @endif
    @else
        <button wire:click="sendRequest"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Request Admin Access 💚
        </button>
    @endif
</div>
