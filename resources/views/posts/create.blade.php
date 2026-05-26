<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Post') }} 
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data"> 
                        @csrf 

                        @if ($errors->any())
                            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                <p class="font-semibold">Por favor corrija os erros abaixo:</p>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div>
                            <div class="mt-2 mb-2">
                                <label for="name">Titulo:</label>
                            </div>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"> 
                        </div>
                        <div>
                            <div class="mt-2 mb-2">
                                <label for="name">Texto:</label>
                            </div>
                            <textarea name="text" id="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('text') }}</textarea>
                        </div>
                        <div>
                            <div class="mb-2">
                                <label for="categorias_id">Categorias:</label>
                            </div>
                            <select id="categorias_id" name="categorias_id" class="col-start-1 row-start-1 appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @selected(old('categorias_id') == $categoria->id)>{{ $categoria->name }}</option>
                                @endforeach
                            </select>                            
                        </div>

                        <!-- INPUT DE IMAGEM -->
                        <div class="mt-4">
                            <div class="mt-2 mb-2">
                                <label for="image">Imagem do Post (opcional):</label>
                            </div>
                            <div class="mt-1">
                                <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF até 2MB</p>
                            <img id="preview" class="mt-4 max-h-40 rounded-lg" style="display:none;" alt="Preview">
                        </div>
                        <div class="mt-2 mb-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const fileInput = document.getElementById('image');
        const preview = document.getElementById('preview');
        if (fileInput) {
            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</x-app-layout>