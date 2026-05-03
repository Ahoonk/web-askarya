<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        return view('admin.clients.index', [
            'clients' => Client::query()->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Client::create([
            ...$data,
            'image_path' => $this->storeImage($request),
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client berhasil ditambahkan.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $this->validateData($request);
        $imagePath = $client->image_path;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $this->storeImage($request);
        } elseif ($request->boolean('remove_image') && $imagePath) {
            Storage::disk('public')->delete($imagePath);
            $imagePath = null;
        }

        $client->update([
            ...$data,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client berhasil diperbarui.');
    }

    public function destroy(Client $client)
    {
        if ($client->image_path) {
            Storage::disk('public')->delete($client->image_path);
        }

        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
        ]);
    }

    private function storeImage(Request $request): ?string
    {
        return $request->file('image')?->store('clients', 'public');
    }
}
