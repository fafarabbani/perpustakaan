<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Data Pengembalian') }}
            </h2>

            <!-- Breadcrumb -->
            <ol class="inline-flex items-center space-x-2 md:space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-500 hover:underline hover:text-gray-500 dark:text-gray-400 dark:hover:text-white">
                        {{ __('Menu Transaksi') }}
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center px-1">
                        <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 px-1 text-sm font-medium text-gray-400 md:ms-2 dark:text-gray-400">
                            {{ __('Data Pengembalian') }}
                        </span>
                    </div>
                </li>
            </ol>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="rounded-md bg-[#C4F9E2] p-4 mb-3">
            <p class="flex items-center text-sm font-medium text-[#004434]">
                <span class="pr-3">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="10" r="10" fill="#00B078" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.1203 6.78954C14.3865 7.05581 14.3865 7.48751 14.1203 7.75378L9.12026 12.7538C8.85399 13.02 8.42229 13.02 8.15602 12.7538L5.88329 10.4811C5.61703 10.2148 5.61703 9.78308 5.88329 9.51682C6.14956 9.25055 6.58126 9.25055 6.84753 9.51682L8.63814 11.3074L13.156 6.78954C13.4223 6.52328 13.854 6.52328 14.1203 6.78954Z"
                            fill="white" />
                    </svg>
                </span>
                {{ session('success') }}
            </p>
        </div>
    @endif
    @if ($errors->any())
        <div
            class="w-full bg-red-700/15 inline-flex rounded-lg px-[18px] py-4 shadow-[0px_2px_10px_0px_rgba(0,0,0,0.08)] mb-3">
            <p class="flex items-center text-sm font-medium text-[#BC1C21]">
                <span class="bg-red-700 mr-3 flex h-5 w-5 items-center justify-center rounded-full">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_961_15656)">
                            <path
                                d="M6 0.337494C2.86875 0.337494 0.3375 2.86874 0.3375 5.99999C0.3375 9.13124 2.86875 11.6812 6 11.6812C9.13125 11.6812 11.6813 9.13124 11.6813 5.99999C11.6813 2.86874 9.13125 0.337494 6 0.337494ZM6 10.8375C3.3375 10.8375 1.18125 8.66249 1.18125 5.99999C1.18125 3.33749 3.3375 1.18124 6 1.18124C8.6625 1.18124 10.8375 3.35624 10.8375 6.01874C10.8375 8.66249 8.6625 10.8375 6 10.8375Z"
                                fill="white" />
                            <path
                                d="M7.725 4.25625C7.55625 4.0875 7.29375 4.0875 7.125 4.25625L6 5.4L4.85625 4.25625C4.6875 4.0875 4.425 4.0875 4.25625 4.25625C4.0875 4.425 4.0875 4.6875 4.25625 4.85625L5.4 6L4.25625 7.14375C4.0875 7.3125 4.0875 7.575 4.25625 7.74375C4.33125 7.81875 4.44375 7.875 4.55625 7.875C4.66875 7.875 4.78125 7.8375 4.85625 7.74375L6 6.6L7.14375 7.74375C7.21875 7.81875 7.33125 7.875 7.44375 7.875C7.55625 7.875 7.66875 7.8375 7.74375 7.74375C7.9125 7.575 7.9125 7.3125 7.74375 7.14375L6.6 6L7.74375 4.85625C7.89375 4.6875 7.89375 4.425 7.725 4.25625Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_961_15656">
                                <rect width="12" height="12" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </span>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </p>
        </div>
    @endif

    <div class="p-3 overflow-hidden bg-white mb-3 rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="pb-3 px-2 flex justify-between items-center">
            <h2 class="text-base font-bold leading-7 text-primary dark:text-secondary">
                {{ __('Pengembalian') }}
            </h2>
        </div>
        <form action="" method="POST" class="px-3">
            @csrf
            <div class="grid gap-3 md:grid-cols-1">
                <div>
                    <label for="kode_transaksi" class="block text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('Kode Transaksi :') }}
                    </label>
                    <select name="kode_transaksi" id="kode_transaksi"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm/6 rounded-lg focus:ring-primary focus:border-primary block w-full py-1.5 pl-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary" 
                        required>
                        <option>-- Pilih --</option>
                        @foreach ($bukuDipinjam as $item)
                            <option value="{{ $item->id }}" {{ old('kode_transaksi') == $item->id ? 'selected' : '' }}>
                                {{ $item->kode_transaksi }} — {{ $item->anggota->nama ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    @error('kode_transaksi')
                        <p class="mt-[5px] text-xs text-red-700">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <x-button size="sm" variant="primary" type="submit" class="justify-center mt-3 max-w-xs gap-2">
                <span>{{ __('Simpan') }}</span>
            </x-button>
        </form>
    </div>

    <div class="p-3 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="pb-1 px-2 flex justify-between items-center">
            <div>
                <h2 class="text-base font-bold leading-7 text-primary dark:text-secondary">
                    {{ __('Data Pengembalian') }}
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-300">
                    {{ __('This information will be displayed publicly so be careful what you share.') }}
                </p>
            </div>
        </div>

        <!-- Start coding here -->
        <div class="bg-white dark:bg-dark-eval-1 sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="w-full relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary"
                                placeholder="Search" required="">
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center">{{ __('Kode Transaksi') }}</th>
                            <th scope="col" class="px-4 py-3 text-center">{{ __('Tanggal Kembali') }}</th>
                            <th scope="col" class="px-4 py-3 text-center">{{ __('Nama Anggota') }}</th>
                            <th scope="col" class="px-4 py-3 text-center">{{ __('Buku Yang Dipinjam') }}</th>
                            <th scope="col" class="px-4 py-3 text-center">{{ __('Status') }}</th>
                            <th scope="col" class="px-2 py-1 text-center">
                                <span>{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            @foreach ($item->detailPeminjaman as $detail)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 text-center hidden">
                                        {{ $item->id }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        {{ $item->kode_transaksi }}
                                    </td>

                                    <th scope="row"
                                        class="px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $detail->tanggal_kembali_formatted ?? '-' }}
                                    </th>

                                    <td class="px-4 py-3 text-center">
                                        {{ $item->anggota->nama }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        {{ $detail->buku->judul ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        @if ($item->status == 'dipinjam')
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                {{ __('Dipinjam') }}
                                            </span>
                                        @else
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                {{ __('Dikembalikan') }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-2 py-3 flex items-center justify-center gap-1">
                                        <x-button class="hover:underline" size="sm" variant="info"
                                            data-modal-target="modal-detail"
                                            data-modal-toggle="modal-detail"
                                            data-nomor-anggota="{{ $item->anggota->nomor_anggota }}"
                                            data-nama="{{ $item->anggota->nama }}"
                                            data-telepon="{{ $item->anggota->telepon }}"
                                            data-kode="{{ $item->kode_transaksi }}"
                                            data-tanggal-kembali="{{ $detail->tanggal_kembali_formatted ?? '-' }}"
                                            data-buku="{{ $detail->buku->judul ?? '-' }}"
                                            data-status="{{ $item->status }}">
                                            {{ __('Detail') }}
                                        </x-button>
                                        {{--  <x-button class="hover:underline" href="" size="sm" variant="primary">
                                            {{ __('Edit') }}
                                        </x-button>  --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        
                        <!-- Modal Detail Anggota -->
                        <div id="modal-detail" tabindex="-1" aria-hidden="true"
                            class="hidden fixed inset-0 z-50 justify-center items-center bg-black/50">
                            <div class="bg-white dark:bg-gray-700 rounded-lg w-full max-w-md p-5 relative shadow">
                                <!-- Modal Header -->
                                <div class="flex justify-between items-center border-b pb-3">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Anggota</h3>
                                    <button type="button" data-modal-hide="modal-detail"
                                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-2 dark:hover:bg-gray-600 dark:hover:text-white">
                                        ✕
                                    </button>
                                </div>

                                <!-- Modal Body -->
                                <div class="mt-4 space-y-2">
                                    <p><strong>Nomor Anggota:</strong> <span id="detail-nomor-anggota"></span></p>
                                    <p><strong>Nama:</strong> <span id="detail-nama"></span></p>
                                    <p><strong>Telepon:</strong> <span id="detail-telepon"></span></p>
                                    <p><strong>Kode Transaksi:</strong> <span id="detail-kode"></span></p>
                                    <p><strong>Tanggal Kembali:</strong> <span id="detail-tanggal-kembali"></span></p>
                                    <p><strong>Buku:</strong> <span id="detail-buku"></span></p>
                                    <p><strong>Status:</strong> <span id="detail-status"></span></p>
                                </div>

                                <!-- Modal Footer -->
                                <div class="flex justify-end mt-5 border-t pt-3">
                                    <button data-modal-hide="modal-detail" type="button"
                                        class="text-white bg-blue-600 hover:bg-blue-700 rounded-lg px-4 py-2">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if ($data->isEmpty())
                            <tr class="justify-center items-center p-4">
                                <td></td>
                                <td></td>
                                <td colspan="5" class="px-2 py-1 flex items-center justify-center gap-1">
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ __('Data Masih Kosong') }}
                                    </span>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                    {{ $data->links() }}
                </table>

                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <a href="#"
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page"
                                class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const buttons = document.querySelectorAll("[data-modal-target='modal-detail']");

        buttons.forEach(btn => {
            btn.addEventListener("click", () => {
                // Ambil data dari tombol
                const nomor_anggota = btn.getAttribute("data-nomor-anggota");
                const nama = btn.getAttribute("data-nama");
                const telepon = btn.getAttribute("data-telepon");
                const kode = btn.getAttribute("data-kode");
                const tanggalKembali = btn.getAttribute("data-tanggal-kembali");
                const buku = btn.getAttribute("data-buku");
                const status = btn.getAttribute("data-status");

                // Isi modal
                document.getElementById("detail-nomor-anggota").textContent = nomor_anggota;
                document.getElementById("detail-nama").textContent = nama;
                document.getElementById("detail-telepon").textContent = telepon;
                document.getElementById("detail-kode").textContent = kode;
                document.getElementById("detail-tanggal-kembali").textContent = tanggalKembali;
                document.getElementById("detail-buku").textContent = buku;
                document.getElementById("detail-status").textContent =
                    status === 'dipinjam'
                        ? 'Dipinjam'
                        : 'Dikembalikan';
            });
        });
    });
</script>

