<x-admin-app-layout>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hola') }}, {{ auth()->user()->name }}!
        </h2>
        <div class="text-gray-200">{{ \Carbon\Carbon::now()->timezone('America/Costa_Rica')->format('l jS \of F Y ') }}</div>
        </div>
    </x-slot>
    
    <div class="flex w-full">
        <x-slot name="sidebar">
            <div class="flex flex-col mt-2 gap-2 bg-gray-800 shadow-sm rounded-lg">
                <section class="flex flex-col p-2 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-lg text-center text-gray-200 leading-tight">
                        Tipo cambio
                    </h2>
                    <div class="mt-2 flex flex-col justify-between items-center">
                        <div class="flex flex-col items-center gap-2">
                            <span class="text-sm font-semibold">BCCR</span>
                            <span class="text-sm">Compra {{ \Carbon\Carbon::now()->format('d') }}</span>
                            <span class="text-sm">Venta {{ \Carbon\Carbon::now()->format('m') }}</span>
                        </div>                        
                        <div class="flex flex-col items-center gap-2 mt-2">
                            <span class="text-sm font-semibold">Financiera Cafsa</span>
                            <span class="text-sm">Compra {{ \Carbon\Carbon::now()->format('d') }}</span>
                            <span class="text-sm">Venta {{ \Carbon\Carbon::now()->format('m') }}</span>
                        </div>                        
                        <div class="flex flex-col items-center gap-2 mt-2">
                            <span class="text-sm font-semibold">Arrendadora Cafsa</span>
                            <span class="text-sm">Compra {{ \Carbon\Carbon::now()->format('d') }}</span>
                            <span class="text-sm">Venta {{ \Carbon\Carbon::now()->format('m') }}</span>
                        </div>
                    </div>
                </section>
            </div>
        </x-slot>
        
        <div class="flex justify-center align-middle mt-2 gap-2 mx-auto">
            <section class="flex mx-auto">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                    <div class="p-2 mt-2 text-gray-100">
                        {{ __("Haz iniciado sesión!") }}
                    </div>
                    <div class="p-2 text-gray-900 dark:text-gray-100">
                        <section class="flex flex-col p-2 text-gray-900 dark:text-gray-100">
                            <h2 class="font-semibold text-base text-center text-gray-200 leading-tight">
                                Colocación mensual {{ \Carbon\Carbon::now()->timezone('America/Costa_Rica')->format('Y') }}
                            </h2>
                            <div class="mt-2 flex flex-row justify-around items-center">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="text-sm font-semibold">Financiera Cafsa S.A</span>
                                    <span class="text-sm">Colones: {{ \Carbon\Carbon::now()->format('d') }}</span>
                                    <span class="text-sm">Dólares: {{ \Carbon\Carbon::now()->format('m') }}</span>
                                </div>                        
                                <div class="flex flex-col items-center gap-2 mt-2">
                                    <span class="text-sm font-semibold">Arrendadora Cafsa</span>
                                    <span class="text-sm">Colones: {{ \Carbon\Carbon::now()->format('d') }}</span>
                                    <span class="text-sm">Dólares: {{ \Carbon\Carbon::now()->format('m') }}</span>
                                </div>                        
                            </div>
                            
                            <section class="flex flex-row justify-center items-center gap-2 mt-2">
                                <div class="chart-container w-[60dvh] h-[40dvh] lg:w-[100dvh] lg:h-[45dvh]">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </section>
                        </section>
                    </div>
                </div>
            </section>
        </div>  
    </div>
    
    @push('scripts')
        <script>
            var data = {
                labels: @json($users->map(fn($users) => $users->name)),
                datasets: [
                {
                    label: 'Monthly Users',
                    //backgroundColor: 'rgba(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: @json($users->map(fn($users) => $users->created_at->format('d'))),
                    tension: 0.1,
                    borderWidth: 2,
                    showLine: true,
                    fill: false,
                },
                {
                    label: 'Monthly Users',
                    //backgroundColor: 'rgba(222, 150, 255)',
                    borderColor: 'rgb(222, 150, 255)',
                    data: @json($users->map(fn($users) => $users->created_at->format('m'))),
                    tension: 0.1,
                    borderWidth: 2,
                    showLine: true,
                    fill: false,
                }]
            }
            
            Chart.defaults.font.size = 9;
            var config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    aspectRatio: 4/3,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                font: {
                                    size: 11,
                                    family: 'Figtree',
                                    style: 'normal',
                                },
                            },
                        },
                        title: {
                            display: true,
                            text: 'Monthly Users',
                            font: {
                                size: 18,
                                family: 'Figtree',
                                style: 'normal',
                            },
                            color: 'rgb(255, 255, 255)',
                        },
                    
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                }
            }
            
            var myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
            
        </script>
    @endpush
</x-admin-app-layout>
