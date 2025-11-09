<div class="p-4 bg-white rounded shadow-xl max-w-lg mx-auto text-center">
    <h2 class="text-2xl font-bold mb-4 text-green-500">Upload Documents</h2>
    <input type="file" wire:model="docs" class="mb-3 border rounded p-2 w-full">
    <button wire:click="upload" class="bg-[#39ff14] text-black font-bold px-4 py-2 rounded">
        Submit Request
    </button>
    <div class="mt-4 text-sm text-gray-600">{{ $statusMessage }}</div>
</div>
