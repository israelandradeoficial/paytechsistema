<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.site_settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        // Handle specific site images
        $siteImages = [
            'logo_system',
            'logo_site',
            'logo_footer',
            'favicon',
            'hero_slide1_image',
            'hero_slide2_image',
            'about_image',
            'machine1_image',
            'machine2_image',
            'machine3_image'
        ];

        foreach ($siteImages as $imageKey) {
            if ($request->hasFile($imageKey)) {
                $path = $request->file($imageKey)->store('site', 'public');
                Setting::set($imageKey, $path);
            }
        }

        // Save all other text settings
        foreach ($data as $key => $value) {
            // Skip file inputs as they are handled above
            if (!in_array($key, $siteImages)) {
                $saveValue = is_string($value) ? trim($value) : $value;

                // Special handling for google_maps_embed_url: extract src if full iframe tag is pasted
                if ($key === 'google_maps_embed_url' && !empty($saveValue)) {
                    if (preg_match('/src="([^"]+)"/', $saveValue, $matches)) {
                        $saveValue = $matches[1];
                    }
                }

                Setting::set($key, $saveValue);
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Personalização do site atualizada com sucesso!'
            ]);
        }

        return redirect()->back()->with('success', 'Personalização do site atualizada com sucesso!');
    }
}
