<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services', ['cards' => ServiceCard::orderBy('order')->orderBy('id')->get()]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'items' => 'array',
            'items.*.title' => 'nullable|string|max:120',
            'items.*.description' => 'nullable|string|max:500',
            'items.*.url' => 'nullable|string|max:500',
            'items.*.icon_file' => 'nullable|image|max:4096',
        ]);

        foreach ($request->input('items', []) as $key => $data) {
            $isNew = str_starts_with((string) $key, 'new_');
            $card = $isNew ? new ServiceCard : ServiceCard::find($key);

            if (! $card) {
                continue;
            }

            if (! empty($data['delete']) || ($isNew && trim($data['title'] ?? '') === '')) {
                if (! $isNew) {
                    $this->deleteUpload($card->icon);
                    $card->delete();
                }

                continue;
            }

            $card->fill([
                'title' => trim($data['title'] ?? '') ?: 'Untitled',
                'description' => str_replace("\r\n", "\n", (string) ($data['description'] ?? '')),
                'url' => trim($data['url'] ?? '') ?: '#',
                'is_active' => ! empty($data['is_active']),
                'order' => (int) ($data['order'] ?? 0),
            ]);

            if ($file = $request->file("items.$key.icon_file")) {
                $this->deleteUpload($card->icon);
                $card->icon = 'storage/'.$file->store('uploads', 'public');
            }

            $card->save();
        }

        return redirect()->route('admin.services')->with('success', 'Service cards saved.');
    }

    private function deleteUpload(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/uploads/')) {
            Storage::disk('public')->delete(substr($path, strlen('storage/')));
        }
    }
}
