<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menus', [
            'header' => MenuItem::at('header')->get(),
            'footer' => MenuItem::at('footer')->get(),
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'items' => 'array',
            'items.*.label' => 'nullable|string|max:120',
            'items.*.url' => 'nullable|string|max:500',
            'items.*.location' => 'required|in:header,footer',
        ]);

        foreach ($request->input('items', []) as $key => $data) {
            $isNew = str_starts_with((string) $key, 'new_');
            $item = $isNew ? new MenuItem : MenuItem::find($key);

            if (! $item) {
                continue;
            }

            if (! empty($data['delete']) || ($isNew && trim($data['label'] ?? '') === '')) {
                if (! $isNew) {
                    $item->delete();
                }

                continue;
            }

            $item->fill([
                'location' => $data['location'],
                'label' => trim($data['label'] ?? '') ?: 'Untitled',
                'url' => trim($data['url'] ?? '') ?: '#',
                'is_button' => ! empty($data['is_button']),
                'is_active' => ! empty($data['is_active']),
                'order' => (int) ($data['order'] ?? 0),
            ])->save();
        }

        return redirect()->route('admin.menus')->with('success', 'Menus saved.');
    }
}
