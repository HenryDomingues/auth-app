<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('categoria')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('posts.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validar dados
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB
            'categorias_id' => 'required|exists:categorias,id',
        ], [
            'image.image' => 'O arquivo deve ser uma imagem válida.',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'image.max' => 'A imagem não pode ser maior que 2MB.',
        ]);

        // Processar upload da imagem
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }

        // Criar post
        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    public function edit(Post $post)
    {
        $categorias = Categoria::all();
        return view('posts.edit', compact('post', 'categorias'));
    }

    public function update(Request $request, Post $post)
    {
        // Validar dados
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'categorias_id' => 'required|exists:categorias,id',
        ], [
            'image.image' => 'O arquivo deve ser uma imagem válida.',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg, gif ou webp.',
            'image.max' => 'A imagem não pode ser maior que 5MB.',
        ]);

        // Processar upload da nova imagem
        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        } elseif ($request->has('remove_image') && $request->boolean('remove_image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = null;
        }

        // Atualizar post
        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy(Post $post)
    {
        // Deletar imagem se existir
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        // Deletar post
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deletado com sucesso!');
    }
}