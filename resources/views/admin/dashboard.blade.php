@extends('admin.layouts.app')

@section('title', 'Dashboard Status Kamar')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Pie Chart Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-700">Distribusi Status Kamar</h2>
                </div>
                <div class="p-6">
                    <canvas id="roomStatusChart" height="250"></canvas>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-700">Ringkasan Kamar</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <h3 class="text-center text-gray-600 font-medium">Total Kamar</h3>
                            <p class="text-center text-3xl font-bold text-blue-600 mt-2">{{ $totalRooms }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                            <h3 class="text-center text-gray-600 font-medium">Terisi</h3>
                            <p class="text-center text-3xl font-bold text-green-600 mt-2">{{ $occupiedRooms }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Ketersediaan Kamar</span>
                            <span class="text-sm font-medium text-gray-700">{{ $availabilityPercentage }}% Tersedia</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $availabilityPercentage }}%">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                <span class="text-sm text-gray-600">Tersedia</span>
                            </div>
                            <span class="text-sm font-medium">{{ $availableRooms }} Kamar</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                                <span class="text-sm text-gray-600">Terisi</span>
                            </div>
                            <span class="text-sm font-medium">{{ $occupiedRooms }} Kamar</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                                <span class="text-sm text-gray-600">Perawatan</span>
                            </div>
                            <span class="text-sm font-medium">{{ $maintenanceRooms }} Kamar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-700">Aktivitas Terkini</h2>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Kamar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Update</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($recentActivities as $activity)
                            @php
                                $status = strtolower($activity->status);
                                $badgeColor = match ($status) {
                                    'tersedia' => 'green',
                                    'terisi' => 'red',
                                    'perawatan' => 'yellow',
                                    default => 'gray',
                                };
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $activity->no_kamar }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="bg-{{ $badgeColor }}-100 text-{{ $badgeColor }}-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ ucfirst($activity->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $activity->updated_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Admin</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Line Chart Section -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 mt-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Diagram Pendapatan & Biaya</h1>
            <div class="w-full h-96">
                <canvas id="revenueCostChart"></canvas>
            </div>
            <div class="mt-4 flex justify-between text-sm text-gray-600">
                <div>Periode: Januari - Desember 2023</div>
                <div>Satuan: Juta Rupiah</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('roomStatusChart').getContext('2d');
            const roomStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Tersedia', 'Terisi', 'Dalam Perawatan'],
                    datasets: [{
                        data: [
                            {{ $availableRooms }},
                            {{ $occupiedRooms }},
                            {{ $maintenanceRooms }}
                        ],
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.8)', // Tersedia (Green)
                            'rgba(239, 68, 68, 0.8)', // Terisi (Red)
                            'rgba(245, 158, 11, 0.8)' // Perawatan (Yellow)
                        ],
                        borderColor: [
                            'rgba(16, 185, 129, 1)', // Green border
                            'rgba(239, 68, 68, 1)', // Red border
                            'rgba(245, 158, 11, 1)' // Yellow border
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((context.raw / total) * 100);
                                    return `${context.label}: ${context.raw} Kamar (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

            // Line Chart
            const lineCtx = document.getElementById('revenueCostChart').getContext('2d');
            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    datasets: [{
                            label: 'Pendapatan',
                            data: [15, 18, 22, 25, 28, 30, 32, 35, 38, 40, 42, 45],
                            borderColor: 'rgba(59, 130, 246, 1)', // Blue
                            backgroundColor: 'rgba(59, 130, 246, 0.2)', // Soft blue fill
                            borderWidth: 4,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Biaya',
                            data: [10, 12, 15, 18, 20, 22, 25, 23, 20, 22, 25, 28],
                            borderColor: 'rgba(239, 68, 68, 1)', // Red
                            backgroundColor: 'rgba(239, 68, 68, 0.2)', // Soft red fill
                            borderWidth: 4,
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + ' JT';
                                }
                            },
                            grid: {
                                borderColor: 'rgba(0,0,0,0.1)',
                                borderWidth: 1
                            }
                        },
                        x: {
                            grid: {
                                borderColor: 'rgba(0,0,0,0.1)',
                                borderWidth: 1
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        });
    </script>
@endpush
