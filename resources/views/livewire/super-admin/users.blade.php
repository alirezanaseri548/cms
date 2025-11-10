<div class="p-8 bg-white rounded-xl shadow-lg w-full">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Super‑Admin Control Panel 💼
    </h2>

    @if (session()->has('msg'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
            {{ session('msg') }}
        </div>
    @endif

    {{-- Section 1: Admin Requests --}}
    <h3 class="text-xl font-semibold mb-3 text-orange-600">Pending Admin Requests</h3>
    @if ($requests->count() > 0)
        <table class="min-w-full border-collapse border border-gray-300 text-sm mb-8">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="border px-3 py-2">User</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $req)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2">{{ $req->user->name }} ({{ $req->user->email }})</td>
                        <td class="border px-3 py-2">{{ ucfirst($req->status) }}</td>
                        <td class="border px-3 py-2 text-center space-x-2">
                            @if($req->status === 'pending')
                                <button wire:click="approveRequest({{ $req->id }})"
                                    class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">Approve ✅</button>
                                <button wire:click="rejectRequest({{ $req->id }})"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Reject ❌</button>
                            @else
                                <span class="text-gray-500 italic">Finalized</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500 mb-8">No pending admin requests.</p>
    @endif

    {{-- Section 2: All Users --}}
    <h3 class="text-xl font-semibold mb-3 text-blue-600">All Users</h3>
    <table class="min-w-full border-collapse border border-gray-300 text-sm bg-white">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="border px-3 py-2">ID</th>
                <th class="border px-3 py-2">Name</th>
                <th class="border px-3 py-2">Email</th>
                <th class="border px-3 py-2">Role</th>
                <th class="border px-3 py-2">Change Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2">{{ $user->id }}</td>
                    <td class="border px-3 py-2">{{ $user->name }}</td>
                    <td class="border px-3 py-2">{{ $user->email }}</td>
                    <td class="border px-3 py-2 text-center">
                        <span class="px-2 py-1 rounded bg-green-50 text-green-700 font-semibold">
                            {{ $user->roles->first()->name ?? 'none' }}
                        </span>
                    </td>
                    <td class="border px-3 py-2 text-center space-x-2">
                        <button wire:click="setRoleManually({{ $user->id }}, 'user')"
                            class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">User</button>
                        <button wire:click="setRoleManually({{ $user->id }}, 'admin')"
                            class="px-2 py-1 bg-orange-500 text-white rounded hover:bg-orange-600">Admin</button>
                        <button wire:click="setRoleManually({{ $user->id }}, 'super-admin')"
                            class="px-2 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">Super‑Admin</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
