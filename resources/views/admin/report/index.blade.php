<x-admin-layout>
    <div id="app" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Report Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 animate-slide-in">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-[#FE6700]/10 mr-4">
                    <i class='bx bx-line-chart text-3xl text-[#FE6700]'></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Ticket Sales Report</h2>
                    <p class="text-sm text-gray-500">Revenue analytics and performance metrics</p>
                </div>
            </div>
        </div>

        <!-- Revenue Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Revenue -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-[#FE6700] transition-all duration-700 opacity-0 translate-y-4" v-bind:class="{ 'opacity-100 translate-y-0': isVisible }">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                        <p class="text-2xl font-bold text-gray-800">TZS @{{ formatCurrency(totalRevenue) }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-[#FE6700]/10">
                        <i class='bx bx-money text-xl text-[#FE6700]'></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-600">
                    <i class='bx bx-up-arrow-alt mr-1'></i>
                    <span>@{{ growthPercentage }}% from last period</span>
                </div>
            </div>

            <!-- General Tickets -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 transition-all duration-700 opacity-0 translate-y-4 delay-100" v-bind:class="{ 'opacity-100 translate-y-0': isVisible }">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">General Tickets</p>
                        <p class="text-2xl font-bold text-gray-800">@{{ vipTicketsCount }}</p>
                        <p class="text-sm text-gray-500">TZS @{{ formatCurrency(vipRevenue) }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-blue-100">
                        <i class='bx bx-group text-xl text-blue-500'></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="h-1 w-full bg-gray-200 rounded-full">
                        <div class="h-1 bg-blue-500 rounded-full" :style="{ width: vipPercentage + '%' }"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">@{{ vipPercentage }}% of total revenue</p>
                </div>
            </div>

            <!-- VIP Tickets -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 transition-all duration-700 opacity-0 translate-y-4 delay-200" v-bind:class="{ 'opacity-100 translate-y-0': isVisible }">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">VIP Tickets</p>
                        <p class="text-2xl font-bold text-gray-800">@{{ generalTicketsCount }}</p>
                        <p class="text-sm text-gray-500">TZS @{{ formatCurrency(generalRevenue) }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-green-100">
                        <i class='bx bx-star text-xl text-green-500'></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="h-1 w-full bg-gray-200 rounded-full">
                        <div class="h-1 bg-green-500 rounded-full" :style="{ width: generalPercentage + '%' }"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">@{{ generalPercentage }}% of total revenue</p>
                </div>
            </div>
        </div>

        <!-- Profit Graph -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 transition-all duration-700 opacity-0 translate-y-4 delay-300" v-bind:class="{ 'opacity-100 translate-y-0': isVisible }">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Daily Profit Analysis</h3>
                <div class="flex space-x-2 mt-3 sm:mt-0">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class='bx bx-circle mr-1'></i> VIP Tickets
                    </span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class='bx bx-circle mr-1'></i> General Tickets
                    </span>
                </div>
            </div>
            <div class="h-80">
                <canvas id="profitChart"></canvas>
            </div>
        </div>

        <!-- Download Button -->
        <div class="mt-6">
            <a href="{{ route('admin.sales-report.download') }}"
               class="px-4 py-2 bg-[#808080] text-white rounded-lg hover:bg-[#808080] transition inline-block"
               target="_blank"
               rel="noopener noreferrer">
                Download Report
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.31/dist/vue.global.prod.js"></script>
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    totalRevenue: {{ $totalRevenue }},
                    vipRevenue: {{ $vipRevenue }},
                    generalRevenue: {{ $generalRevenue }},
                    vipTicketsCount: {{ $vipTicketsCount }},
                    generalTicketsCount: {{ $generalTicketsCount }},
                    growthPercentage: {{ $growthPercentage }},
                    vipPercentage: {{ $vipPercentage }},
                    generalPercentage: {{ $generalPercentage }},
                    dailyProfits: @json($dailyProfits),
                    isVisible: false
                }
            },
            methods: {
                formatCurrency(value) {
                    return new Intl.NumberFormat().format(value);
                },
                updateChartData(days) {
                    console.log("Update chart for last " + days + " days");
                }
            },
            mounted() {
                // Animate cards on mount
                setTimeout(() => {
                    this.isVisible = true;
                }, 100);

                // Chart initialization
                const ctx = document.getElementById('profitChart').getContext('2d');
                this.chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: this.dailyProfits.map(day => day.date),
                        datasets: [
                            {
                                label: 'VIP Tickets',
                                data: this.dailyProfits.map(day => day.vip_amount),
                                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                                borderRadius: 4
                            },
                            {
                                label: 'General Tickets',
                                data: this.dailyProfits.map(day => day.general_amount),
                                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                                borderRadius: 4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: { stacked: true, grid: { display: false } },
                            y: {
                                stacked: false,
                                ticks: {
                                    callback: (value) => 'TZS ' + new Intl.NumberFormat().format(value)
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: (context) => {
                                        let label = context.dataset.label || '';
                                        if (label) label += ': ';
                                        return label + 'TZS ' + new Intl.NumberFormat().format(context.raw);
                                    }
                                }
                            },
                            legend: { display: false }
                        }
                    }
                });
            }
        });

        app.mount('#app');
    </script>
</x-admin-layout>
