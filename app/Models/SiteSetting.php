<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /** @var array<string, ?string>|null */
    protected static ?array $cache = null;

    /** Read a setting, falling back to the default declared in config/cms.php. */
    public static function get(string $key, ?string $default = null): ?string
    {
        if (static::$cache === null) {
            static::$cache = Schema::hasTable('site_settings')
                ? static::query()->pluck('value', 'key')->all()
                : [];
        }

        if (array_key_exists($key, static::$cache) && static::$cache[$key] !== null) {
            return static::$cache[$key];
        }

        return $default ?? static::defaultFor($key);
    }

    public static function set(string $key, ?string $value, string $group = 'general'): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        static::$cache = null;
    }

    public static function defaultFor(string $key): ?string
    {
        foreach (config('cms.tabs') as $tab) {
            if (isset($tab['fields'][$key])) {
                return $tab['fields'][$key]['default'] ?? null;
            }
        }

        return null;
    }

    /** Public URL for an uploaded or bundled image path. */
    public static function image(string $key): ?string
    {
        $path = static::get($key);

        if (! $path) {
            return null;
        }

        return preg_match('#^(https?:)?//#', $path) ? $path : asset(ltrim($path, '/'));
    }
}
