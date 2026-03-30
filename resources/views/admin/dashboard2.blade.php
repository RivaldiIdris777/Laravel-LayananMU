@extends('layouts.admin')

@section('title','Dashboard LayananMu - Jambi')

@section('styles')
@endsection

@section('contentadmin')
<div class="max-w-7xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Main Menu</h1>        
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-slate-500">Total User</p>
                    <p class="text-2xl font-semibold text-slate-900">1,234</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-dollar-sign text-slate-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-slate-500">Pendapatan</p>
                    <p class="text-2xl font-semibold text-slate-900">Rp 45.6M</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-full">
                    <i class="fas fa-shopping-cart text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-slate-500">Pesanan</p>
                    <p class="text-2xl font-semibold text-slate-900">567</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 bg-red-100 rounded-full">
                    <i class="fas fa-chart-line text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-slate-500">Growth</p>
                    <p class="text-2xl font-semibold text-slate-900">+23%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table and Form Section -->
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 mb-8">
        <!-- Table -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-slate-900 mb-4">Data Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 px-3 text-sm font-medium text-slate-700">ID</th>
                            <th class="text-left py-2 px-3 text-sm font-medium text-slate-700">Nama</th>
                            <th class="text-left py-2 px-3 text-sm font-medium text-slate-700">Status</th>
                            <th class="text-left py-2 px-3 text-sm font-medium text-slate-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-slate-50">
                            <td class="py-2 px-3 text-sm">#001</td>
                            <td class="py-2 px-3 text-sm">Ahmad Rizki</td>
                            <td class="py-2 px-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Aktif</span>
                            </td>
                            <td class="py-2 px-3">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Edit</button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-slate-50">
                            <td class="py-2 px-3 text-sm">#002</td>
                            <td class="py-2 px-3 text-sm">Siti Nurhaliza</td>
                            <td class="py-2 px-3">
                                <span
                                    class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            </td>
                            <td class="py-2 px-3">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Edit</button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-slate-50">
                            <td class="py-2 px-3 text-sm">#003</td>
                            <td class="py-2 px-3 text-sm">Budi Santoso</td>
                            <td class="py-2 px-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Non-aktif</span>
                            </td>
                            <td class="py-2 px-3">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>        
    </div>    
</div>
@endsection
