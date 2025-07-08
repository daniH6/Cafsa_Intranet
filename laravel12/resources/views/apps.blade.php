<x-app-layout>
    @auth('web')
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Aplicaciones') }}
            </h2>
            
            <div class="text-gray-200 text-sm">
                @if(auth()->user()->email)
                    {{ __('Correo electrónico') }}: {{ auth()->user()->email }}
                @endif
            </div>
            <div class="text-gray-200">
                {{ __('Fecha') }}: {{ \Carbon\Carbon::now()->translatedFormat('l jS \de F Y ') }}
            </div>
        </div>
    </x-slot>
    
    <main class="flex flex-col max-w-7xl mx-auto">
        
        <section class="mt-5 px-6 py-4 mx-auto border bg-gray-800 shadow-sm rounded-lg text-center">
            
            <h1 class="text-2xl font-semibold text-white">
                Aplicaciones Cafsa
            </h1>
                
            <p class="text-sm text-white/50">
                En este apartado podrás encontrar las aplicaciones que utiliza la empresa.
            </p>
                
        
        
            <div class="flex justify-start mt-5 ">
                <ul class="list-none ml-5 text-sm text-left">
                    <li class="text-gray-300 hover:text-gray-100">
                        <a href="https://cotizador.cafsa.fi.cr" target="_blank" referrerpolicy="no-referrer">
                            Cotizadores
                        </a>
                    </li>
                    <li class="text-gray-300 hover:text-gray-100">
                        <a href="https://eq-srv-119.cafsa.fi.cr:8001/WebAppCafsaBI/InicioSesionCafsa.jsp" target="_blank" referrerpolicy="no-referrer">
                            Cafsa BI
                        </a>
                    </li>
                    <li class="text-gray-300 hover:text-gray-100">
                        a
                    </li>
                    <li class="text-gray-300 hover:text-gray-100">
                        l
                    </li>
                </ul>
            </div>
                
        </section>
    
    </main>
    
    
    @endauth
</x-app-layout>