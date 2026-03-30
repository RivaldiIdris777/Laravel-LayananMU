@extends('layouts.admin')

@section('title', 'Data Alumni - LayananMu Jambi')

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
        background-color: #2563eb !important; /* Biru (Blue-600) */
        border-color: #2563eb !important;
        color: white !important;
    }
    .custom-pagination nav a:hover {
        background-color: #eff6ff !important; /* Blue-50 */
        color: #1d4ed8 !important; /* Blue-700 */
    }

    /* Memberikan Jarak (Gap) Antar Elemen Pagination */
    .custom-pagination nav {
        gap: 1.5rem; /* Jarak antara blok "Previous/Next" mobile dan teks "Showing..." */
        row-gap: 1rem;
        flex-wrap: wrap;
    }
    .custom-pagination nav .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between,
    .custom-pagination nav > div,
    .custom-pagination nav > div > div {
        gap: 1rem; /* Jarak antara teks "Showing..." dan baris nomor halaman */
        flex-wrap: wrap;
    }
    
    /* Memisahkan setiap tombol nomor agar tidak berhimpitan dan diberi jarak */
    .custom-pagination nav .relative.z-0.inline-flex,
    .custom-pagination nav .isolate.inline-flex {
        gap: 0.375rem; /* Jarak antar tombol angka */
        flex-wrap: wrap;
    }
    .custom-pagination nav p.text-sm.text-gray-700.leading-5 {
        margin-right: 1.5rem;
    }
    .custom-pagination nav .relative.z-0.inline-flex > span,
    .custom-pagination nav .relative.z-0.inline-flex > a,
    .custom-pagination nav .isolate.inline-flex > span,
    .custom-pagination nav .isolate.inline-flex > a {
        margin-left: 0 !important; /* Menghilangkan margin negatif bawaan */
        border-radius: 0.375rem !important; /* Membuat sudut membulat di tiap tombol */
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
        <h1 class="text-3xl font-bold text-slate-900">Data Alumni</h1>
        <div class="flex items-center gap-3">
            <button onclick="openModal('modal-tambah')"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Alumni
            </button>
            <button onclick="openModal('modal-import')"
                class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                </svg>
                Import Data Alumni (Dari Excel)
            </button>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow p-6 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b bg-slate-50">
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">No</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Foto</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Nama</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">NPM</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Jurusan</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Tahun</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Status Kerja</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Status Studi</th>
                    <th class="text-left py-3 px-4 text-slate-600 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($graduations as $graduation)
                    <tr class="border-b hover:bg-slate-50 transition">
                        <td class="py-3 px-4 text-slate-500">{{ $loop->iteration + ($graduations->currentPage() - 1) * $graduations->perPage() }}</td>
                        <td class="py-3 px-4">
                            @if($graduation->photo)
                                <img src="{{ asset('storage/' . $graduation->photo) }}" alt="Foto {{ $graduation->name }}"
                                    class="w-10 h-10 rounded-full object-cover border border-slate-200">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 text-xs font-bold">
                                    {{ strtoupper(substr($graduation->name, 0, 2)) }}
                                </div>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-medium text-slate-800">{{ $graduation->name }}</td>
                        <td class="py-3 px-4 text-slate-600">{{ $graduation->npm }}</td>
                        <td class="py-3 px-4 text-slate-600">{{ $graduation->major }}</td>
                        <td class="py-3 px-4 text-slate-600">{{ $graduation->year }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ strtolower($graduation->status_job) === 'bekerja' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $graduation->status_job }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-600">{{ $graduation->status_major_now }}</td>
                        <td class="py-3 px-4 flex gap-2 items-center">
                            {{-- Edit Button --}}
                            <button onclick="openEdit(
                                {{ $graduation->id }},
                                '{{ addslashes($graduation->name) }}',
                                '{{ $graduation->npm }}',
                                '{{ addslashes($graduation->major) }}',
                                '{{ $graduation->year }}',
                                '{{ addslashes($graduation->status_job) }}',
                                '{{ addslashes($graduation->status_major_now) }}'
                            )"
                                class="text-blue-600 hover:text-blue-800 text-xs font-medium px-2 py-1 rounded border border-blue-200 hover:bg-blue-50 transition">
                                Edit
                            </button>
                            {{-- Delete Form --}}
                            <form action="{{ route('admin.graduation.destroy', $graduation->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data alumni ini?')">
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
                        <td colspan="9" class="py-8 text-center text-slate-400">Belum ada data alumni.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($graduations->hasPages())
            <div class="mt-4 custom-pagination">
                {{ $graduations->links() }}
            </div>
        @endif
    </div>
</div>

{{-- ===== MODAL TAMBAH ALUMNI ===== --}}
<div id="modal-tambah" class="modal-overlay" onclick="closeOnOverlay(event, 'modal-tambah')">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 p-6" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-bold text-slate-800">Tambah Data Alumni</h2>
            <button onclick="closeModal('modal-tambah')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.graduation.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Nama alumni"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">NPM</label>
                    <input type="text" name="npm" required placeholder="Nomor Pokok Mahasiswa"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jurusan</label>
                    <input type="text" name="major" required placeholder="Nama jurusan"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tahun Lulus</label>
                    <input type="text" name="year" required maxlength="4" placeholder="2024"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Pekerjaan</label>
                    <input type="text" name="status_job" required placeholder="Bekerja / Belum Bekerja"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Studi Lanjut</label>
                    <input type="text" name="status_major_now" required placeholder="S2 / Tidak Lanjut"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Foto (opsional)</label>
                <input type="file" name="photo" accept="image/*"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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

{{-- ===== MODAL EDIT ALUMNI ===== --}}
<div id="modal-edit" class="modal-overlay" onclick="closeOnOverlay(event, 'modal-edit')">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 p-6" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-bold text-slate-800">Edit Data Alumni</h2>
            <button onclick="closeModal('modal-edit')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="form-edit" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="edit-name" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">NPM</label>
                    <input type="text" name="npm" id="edit-npm" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jurusan</label>
                    <input type="text" name="major" id="edit-major" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tahun Lulus</label>
                    <input type="text" name="year" id="edit-year" required maxlength="4"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Pekerjaan</label>
                    <input type="text" name="status_job" id="edit-status-job" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Studi Lanjut</label>
                    <input type="text" name="status_major_now" id="edit-status-major" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Foto (opsional)</label>
                <input type="file" name="photo" accept="image/*"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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

{{-- ===== MODAL IMPORT ALUMNI ===== --}}
<div id="modal-import" class="modal-overlay" onclick="closeOnOverlay(event, 'modal-import')">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-bold text-slate-800">Import Data Alumni</h2>
            <button onclick="closeModal('modal-import')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('graduation.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">File Excel</label>
                <div class="flex items-center justify-center w-full">
                    <label for="import-file"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition">
                        <div class="flex flex-col items-center justify-center pt-4 pb-4">
                            <svg class="w-8 h-8 mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                            <p class="text-sm text-slate-500"><span class="font-semibold">Klik untuk pilih file</span> atau drag &amp; drop</p>
                            <p class="text-xs text-slate-400 mt-1">Format yang didukung: .xlsx, .xls</p>
                        </div>
                        <input id="import-file" name="file" type="file" accept=".xlsx,.xls" class="hidden"
                            onchange="document.getElementById('import-filename').textContent = this.files[0]?.name ?? ''">
                    </label>
                </div>
                <p id="import-filename" class="mt-1 text-xs text-slate-500 text-center"></p>
            </div>

            <div class="flex items-center justify-between pt-2">
                <a href="{{ asset('excel/formatalumni.xlsx') }}" download
                    class="text-sm text-emerald-600 hover:text-emerald-800 underline underline-offset-2 flex items-center gap-1 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v13.5m0 0l-4.5-4.5M12 16.5l4.5-4.5M3 19.5h18"/>
                    </svg>
                    Download Template Excel
                </a>
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('modal-import')"
                        class="px-4 py-2 rounded-lg text-sm border border-slate-300 text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg text-sm bg-emerald-600 text-white hover:bg-emerald-700 transition font-medium">
                        Import
                    </button>
                </div>
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

    function openEdit(id, name, npm, major, year, statusJob, statusMajor) {
        const baseUrl = "{{ url('admin2/graduation') }}";
        document.getElementById('form-edit').action = baseUrl + '/' + id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-npm').value = npm;
        document.getElementById('edit-major').value = major;
        document.getElementById('edit-year').value = year;
        document.getElementById('edit-status-job').value = statusJob;
        document.getElementById('edit-status-major').value = statusMajor;
        openModal('modal-edit');
    }

    // Tampilkan modal tambah jika ada error validasi (saat kembali dari store)
    @if($errors->any() && old('npm'))
        openModal('modal-tambah');
    @endif
</script>
@endsection
