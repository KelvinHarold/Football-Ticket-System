<x-admin-layout>
    <div class="px-6 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Business Overview</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @php
                $cards = [
                    ['label' => 'Transactions', 'value' => $transactionsCount, 'color' => 'indigo', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
                    ['label' => 'VIP Tickets', 'value' => $vipTicketsCount, 'color' => 'green', 'icon' => 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z'],
                    ['label' => 'General Tickets', 'value' => $generalTicketsCount, 'color' => 'yellow', 'icon' => 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z'],
                    ['label' => 'Users', 'value' => $usersCount, 'color' => 'pink', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="card-transition bg-white rounded-xl shadow-md overflow-hidden p-6 transition-all duration-700 ease-out transform translate-y-10 opacity-0">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-{{ $card['color'] }}-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-{{ $card['color'] }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">{{ $card['label'] }}</p>
                            <p class="text-2xl font-bold text-{{ $card['color'] }}-600">{{ $card['value'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Chart Section -->
        <div class="bg-white p-6 rounded-xl shadow-md mb-8 chart-container opacity-0 translate-y-10 transition-all duration-1000 ease-out">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Tickets Booking Trend</h2>
                <div class="flex space-x-2">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        VIP: {{ $vipTicketsCount }}
                    </span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        General: {{ $generalTicketsCount }}
                    </span>
                </div>
            </div>
            <div class="h-80">
                <canvas id="ticketsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Animate cards
            document.querySelectorAll('.card-transition').forEach((card, index) => {
                setTimeout(() => {
                    card.classList.remove('translate-y-10', 'opacity-0');
                    card.classList.add('translate-y-0', 'opacity-100');
                }, index * 150);
            });

            // Animate chart container
            setTimeout(() => {
                const chartContainer = document.querySelector('.chart-container');
                chartContainer.classList.remove('translate-y-10', 'opacity-0');
                chartContainer.classList.add('translate-y-0', 'opacity-100');
            }, 700);

            // Chart setup
            const ctx = document.getElementById('ticketsChart').getContext('2d');
            const ticketsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['VIP Tickets', 'General Tickets'],
                    datasets: [{
                        label: 'Tickets Booked',
                        data: [{{ $vipTicketsCount }}, {{ $generalTicketsCount }}],
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderColor: 'rgba(99, 102, 241, 0.8)',
                        borderWidth: 3,
                        pointBackgroundColor: 'rgba(99, 102, 241, 1)',
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1500,
                        easing: 'easeOutQuart'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 20,
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            grid: {
                                color: "rgba(229, 229, 229, 0.8)"
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1F2937',
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' tickets booked';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-admin-layout>
