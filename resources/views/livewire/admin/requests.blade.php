<div class="p-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Admin Requests Panel 💼</h2>

    @if (session()->has('msg'))
        <div class="mb-4 p-4 rounded bg-green-100 text-green-700">
            {{ session('msg') }}
        </div>
    @endif

    <table class="min-w-full border-collapse border border-gray-300 bg-white">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">User Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requests as $req)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $req->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $req->user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $req->user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        @if ($req->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Pending</span>
                        @elseif($req->status == 'approved')
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Approved</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Rejected</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        @if ($req->status == 'pending')
                            <button wire:click="approve({{ $req->id }})"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Approve</button>
                            <button wire:click="reject({{ $req->id }})"
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 ml-2">Reject</button>
                        @else
                            <span class="text-gray-500 italic">No actions</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">No requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
