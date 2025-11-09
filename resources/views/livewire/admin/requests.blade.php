<div class="bg-gray-100 p-6 rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-green-600">Pending Requests</h2>

    @if(session('msg'))
        <div class="mb-4 text-center font-semibold text-[#39ff14]">{{ session('msg') }}</div>
    @endif

    @foreach($requests as $req)
    <div class="flex justify-between items-center bg-white p-3 mb-3 rounded shadow">
        <div>
            <strong>{{ $req->user->name }}</strong> |
            <span class="{{ $req->status == 'pending' ? 'text-yellow-500' : ($req->status == 'approved' ? 'text-green-600' : 'text-red-600') }}">
                {{ ucfirst($req->status) }}
            </span>
        </div>

        @if($req->status == 'pending')
        <div class="space-x-2">
            <button wire:click="approve({{ $req->id }})"
                class="px-3 py-1 rounded bg-green-600 text-white hover:bg-green-700">Approve</button>
            <button wire:click="reject({{ $req->id }})"
                class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700">Reject</button>
        </div>
        @endif
    </div>
    @endforeach
</div>
