<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 mb-6">
                        <a href="{{ route('categorias.create') }}">➕ Adicione uma nova categoria</a>
                    </button>                    
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-6 py-3 text-left font-semibold">Name</th>
                                <th class="border border-gray-300 px-6 py-3 text-left font-semibold">Editar</th>
                                <th class="border border-gray-300 px-6 py-3 text-left font-semibold">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-6 py-3">{{ $categoria->name }}</td>
                                    <td class="border border-gray-300 px-6 py-3">
                                        <a href="{{ route('categorias.edit', $categoria) }}" class="text-green-600 hover:text-green-900 hover:underline">Edit</a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Tem certeza?')" class="text-red-600 hover:text-red-900">
                                                Deletar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

