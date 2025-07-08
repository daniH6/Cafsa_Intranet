<x-app-layout>
    @auth('web')
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Hola') }}, {{ auth()->user()->name }}!
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
        
            <h1 class="text-2xl font-semibold text-white">Clientes restringidos</h1>
            
            <p class="text-sm text-white/50">
                Consulta por nombre o numero de documento de documentación.
            </p>
            
    
    
            <div class="flex flex-col align-middle justify-center items-center">
                <form class="flex flex-row gap-4 text-white" action="{{ route('dashboard') }}" method="GET" id="searchForm">
                    @csrf
                    <select name="field" class="w-full px-6 py-2 mt-6 text-sm truncate text-gray-600 bg-gray-100 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                        <option value="identificacion" {{ request()->input('field') == 'identificacion' ? 'selected' : '' }}>Buscar por identificación</option>
                        <option value="name" {{ request()->input('field') == 'name' ? 'selected' : '' }}>Buscar por nombre</option>
                    </select>
                    
                    <input id="searchInput" type="text" name="search" value="{{ old('search') }}" placeholder="Buscar por nombre o identificación" class="w-full px-6 py-2 truncate mt-6 text-sm text-gray-600 bg-gray-100 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 ">
                    
                    
                    <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold mt-6 py-1 px-6 rounded" type="submit" value="submit">Buscar</button>
                    
                    {{-- Limpiar búsqueda --}}
                    @if (request()->has('search') && !empty(request('search')))
                        <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold mt-6 py-1 px-6 rounded" type="submit" onclick="clearSearch()">Limpiar</button>
                    @endif
                </form>
            </div>
        </section>
        
        <section class="mt-5 mb-12 px-6 py-4 mx-5 border bg-gray-800 shadow-sm rounded-lg text-center">
            <div class="text-white">
                <h1 class="text-xl font-semibold text-white">Lista de clientes restringidos</h1>
                <div class="mt-2 ">
                        @if(isset($restringidos) && count($restringidos) > 0)
                            <table class="table-auto w-full border-separate border rounded border-gray-600 my-5">
                                <tr class="border rounded">
                                    <th class="border border-gray-500 bg-slate-600 rounded">Identificación</th>
                                    <th class="border border-gray-500 bg-slate-600 rounded">Nombre</th>
                                    <th class="border border-gray-500 bg-slate-600 rounded">Descripción</th>
                                </tr>
                                @foreach ($restringidos as $restringido)
                                <tr class="rounded border">
                                    <td class="border border-gray-500 rounded">{{ $restringido->identificacion }}</td>
                                    <td class="border border-gray-500 rounded">{{ $restringido->name }}</td>
                                    <td class="border border-gray-500 rounded">{{ $restringido->description }}</td>
                                </tr>
                                @endforeach
                            </table>
                            
                        @else
                            <p>No se encontraron datos para la busqueda de "{{ request('search') }}".</p>
                        @endif
                        {{ $restringidos->appends(['field' => request('field'),
                            'search' => request('search')])
                         ->links() 
                        }}
                </div>
            </div>
        </section>
    </main>
 
    <script>
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('searchForm').submit();
        }
    </script>
    @endauth
</x-app-layout>
