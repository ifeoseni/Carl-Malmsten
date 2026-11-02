<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CustomizeController extends Controller
{
    public function index(Request $request)
    {
        $tabs = config('cms.tabs');
        $active = $request->query('tab', array_key_first($tabs));
        abort_unless(isset($tabs[$active]), 404);

        return view('admin.customize', compact('tabs', 'active'));
    }

    public function update(Request $request, string $tab)
    {
        $fields = config("cms.tabs.$tab.fields");
        abort_if($fields === null, 404);

        $rules = [];
        foreach ($fields as $key => $field) {
            $rules[$key] = match ($field['type']) {
                'image' => ['nullable', 'image', 'max:8192'],
                'color' => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
                'url' => ['nullable', 'string', 'max:500'],
                default => ['nullable', 'string', 'max:5000'],
            };
        }
        $request->validate($rules);

        foreach ($fields as $key => $field) {
            if ($field['type'] === 'image') {
                if ($request->boolean("reset_$key")) {
                    $this->deleteUpload(SiteSetting::get($key));
                    SiteSetting::set($key, null, $tab);
                } elseif ($request->hasFile($key)) {
                    $this->deleteUpload(SiteSetting::get($key));
                    $path = $request->file($key)->store('uploads', 'public');
                    SiteSetting::set($key, 'storage/'.$path, $tab);
                }

                continue;
            }

            if ($request->has($key)) {
                SiteSetting::set($key, str_replace("\r\n", "\n", (string) $request->input($key)), $tab);
            }
        }

        return redirect()->route('admin.customize', ['tab' => $tab])->with('success', 'Saved. Your changes are live on the website.');
    }

    private function deleteUpload(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/uploads/')) {
            Storage::disk('public')->delete(substr($path, strlen('storage/')));
        }
    }
}
