<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        ICEITech Laravel 9 - CRUD Productos Livewire con JetStream
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-{{ session('type') }}-100 border-t-4 border-{{ session('type') }}-500 rounded-b text-{{ session('type') }}-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-green-500 hover:bg-green-700 text-white py-1 mb-6 px-3 rounded my-3 mt-1">Crear Nuevo Producto</button>
            @if($isOpen)
                @include('livewire.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">Nro.</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Detalle</th>
                        <th class="px-4 py-2 w-60">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="border px-4 py-2">{{ $product['id'] }}</td>
                        <td class="border px-4 py-2">{{ $product['name'] }}</td>
                        <td class="border px-4 py-2">{{ $product['detail'] }}</td>
                        <td class="border px-4 py-2 text-center">
                        <button wire:click="edit({{ $product['id'] }})" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">Editar</button>
                            <button wire:click="delete({{ $product['id'] }})" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>