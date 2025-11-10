<div class="p-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Admin Requests Panel 💼</h2>

    @if (session()->has('msg'))
        <div class="mb-4 p-4 rounded bg-green-100 text-green-700">
            {{ session('msg') }}
        </div>
    @endif

    {{-- ---------------------------------------------------------------- --}}
    {{-- TABLE 1: ADMIN REQUESTS (For Approval/Rejection) --}}
    {{-- ---------------------------------------------------------------- --}}
    <h3 class="text-xl font-semibold mb-4 text-gray-700">Pending Admin Requests</h3>

    <table class="min-w-full border-collapse border border-gray-300 bg-white shadow-md mb-8">
        <thead>
            <tr class="bg-gray-100 text-gray-700">
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
                    {{-- 🟢 FIX: استفاده از ?-> برای جلوگیری از کرش در صورت حذف کاربر --}}
                    <td class="border border-gray-300 px-4 py-2">{{ $req->user?->name ?? 'User Deleted' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $req->user?->email ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        @if ($req->status === 'pending')
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Pending</span>
                        @elseif ($req->status === 'approved')
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Approved</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Rejected</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        @if ($req->status === 'pending')
                            <button wire:click="approve({{ $req->id }})"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Approve
                            </button>
                            <button wire:click="reject({{ $req->id }})"
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 ml-2">
                                Reject
                            </button>
                        @else
                            <span class="text-gray-500 italic">No actions</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">No admin requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ---------------------------------------------------------------- --}}
    {{-- TABLE 2: ALL USERS (New Requirement) --}}
    {{-- ---------------------------------------------------------------- --}}
    <h3 class="text-xl font-semibold mb-4 text-gray-700">All System Users and Roles ({{ $allUsers->count() }})</h3>

    <table class="min-w-full border-collapse border border-gray-300 bg-white shadow-md">
        <thead>
            <tr class="bg-gray-100 text-gray-700">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Role</th>
                <th class="border border-gray-300 px-4 py-2">Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allUsers as $user)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @foreach ($user->roles as $role)
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">{{ ucfirst($role->name) }}</span>
                        @endforeach
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">No users found in the system.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
