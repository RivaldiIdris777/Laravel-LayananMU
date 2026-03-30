@extends('layouts.admin')

@section('title', 'Data User - LayananMu Jambi')

@section('styles')
<style>
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 50;
        align-items: center;
        justify-content: center;
    }
    .modal-overlay.active { display: flex; }

    /* Custom Color Pagination */
    .custom-pagination nav a,
    .custom-pagination nav span,
    .custom-pagination nav p,
    .custom-pagination nav svg {
        color: black !important;
    }
    .custom-pagination nav [aria-current="page"] span {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        color: white !important;
    }
    .custom-pagination nav a:hover {
        background-color: #eff6ff !important;
        color: #1d4ed8 !important;
    }
    .custom-pagination nav {
        gap: 1.5rem;
        row-gap: 1rem;
        flex-wrap: wrap;
    }
    .custom-pagination nav .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between,
    .custom-pagination nav > div,
    .custom-pagination nav > div > div {
        gap: 1rem;
        flex-wrap: wrap;
    }
    .custom-pagination nav .relative.z-0.inline-flex,
    .custom-pagination nav .isolate.inline-flex {
        gap: 0.375rem;
        flex-wrap: wrap;
    }
    .custom-pagination nav p.text-sm.text-gray-700.leading-5 {
        margin-right: 1.5rem;
    }
    .custom-pagination nav .relative.z-0.inline-flex > span,
    .custom-pagination nav .relative.z-0.inline-flex > a,
    .custom-pagination nav .isolate.inline-flex > span,
    .custom-pagination nav .isolate.inline-flex > a {
        margin-left: 0 !important;
        border-radius: 0.375rem !important;
    }
</style>
@endsection

@section('contentadmin')
<div class="max-w-7xl mx-auto">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Page Header --}}
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-900">Data User</h1>
        <button onclick="openModal('modal-tambah')"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah User
        </button>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow p-6 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b bg-slate-50">
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">No</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Avatar</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Nama</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Email</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Role</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b hover:bg-slate-50 transition">
                        <td class="py-3 px-4 text-slate-500">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td class="py-3 px-4">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar {{ $user->name }}"
                                    class="w-10 h-10 rounded-full object-cover border border-slate-200">
                            @else
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-medium text-slate-800">{{ $user->name }}</td>
                        <td class="py-3 px-4 text-slate-600">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 flex gap-2 items-center">
                            {{-- Edit Button --}}
                            <button onclick="openEdit(
                                {{ $user->id }},
                                '{{ addslashes($user->name) }}',
                                '{{ $user->email }}',
                                '{{ $user->role }}'
                            )"
                                class="text-blue-600 hover:text-blue-800 text-xs font-medium px-2 py-1 rounded border border-blue-200 hover:bg-blue-50 transition">
                                Edit
                            </button>
                            {{-- Delete Form --}}
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user {{ addslashes($user->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-800 text-xs font-medium px-2 py-1 rounded border border-red-200 hover:bg-red-50 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="mt-4 custom-pagination">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

{{-- ===== MODAL TAMBAH USER ===== --}}
<div id="modal-tambah" class="modal-overlay" onclick="closeOnOverlay(event, 'modal-tambah')">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-bold text-slate-800">Tambah User</h2>
            <button onclick="closeModal('modal-tambah')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Nama user"
                    value="{{ old('name') }}"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" required placeholder="email@example.com"
                    value="{{ old('email') }}"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required placeholder="Min. 6 karakter"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                <select name="role" required
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
                    <option value="cs" {{ old('role') === 'cs' ? 'selected' : '' }}>Customer Service</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeModal('modal-tambah')"
                    class="px-4 py-2 rounded-lg text-sm border border-slate-300 text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-lg text-sm bg-blue-600 text-white hover:bg-blue-700 transition font-medium">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL EDIT USER ===== --}}
<div id="modal-edit" class="modal-overlay" onclick="closeOnOverlay(event, 'modal-edit')">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-bold text-slate-800">Edit User</h2>
            <button onclick="closeModal('modal-edit')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="form-edit" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="edit-name" required
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" id="edit-email" required
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password Baru <span class="text-slate-400 font-normal">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" placeholder="Min. 6 karakter"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                <select name="role" id="edit-role" required
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeModal('modal-edit')"
                    class="px-4 py-2 rounded-lg text-sm border border-slate-300 text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-lg text-sm bg-blue-600 text-white hover:bg-blue-700 transition font-medium">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.add('active');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    function closeOnOverlay(event, id) {
        if (event.target === document.getElementById(id)) {
            closeModal(id);
        }
    }

    function openEdit(id, name, email, role) {
        const baseUrl = "{{ url('users') }}";
        document.getElementById('form-edit').action = baseUrl + '/' + id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-role').value = role;
        openModal('modal-edit');
    }

    // Tampilkan modal tambah jika ada error validasi (saat kembali dari store)
    @if($errors->any() && old('name'))
        openModal('modal-tambah');
    @endif
</script>
@endsection
