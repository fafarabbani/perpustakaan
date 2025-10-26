<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Data Peminjaman') }}
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
                            {{ __('Data Peminjaman') }}
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


    <div class="p-3 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="pb-1 px-2 flex justify-between items-center">
            <div>
                <h2 class="text-base font-bold leading-7 text-primary dark:text-secondary">
                    {{ __('Data Peminjaman') }}
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-300">
                    {{ __('This information will be displayed publicly so be careful what you share.') }}
                </p>
            </div>
        </div>

        <!-- Start coding here -->
        <div class="bg-white dark:bg-dark-eval-1 sm:rounded-lg overflow-hidden">
        </div>
    </div>
</x-app-layout>
