<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acesso restrito a administradores.');
        }
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acesso restrito a administradores.');
        }
        $data = $request->except('_token');

        // Handle multiple logos
        $logos = ['logo_system', 'logo_simulator', 'logo_pdf', 'favicon'];
        foreach ($logos as $logoKey) {
            if ($request->hasFile($logoKey)) {
                $path = $request->file($logoKey)->store('logos', 'public');
                Setting::set($logoKey, $path);
            }
        }

        // Handle other settings
        foreach ($data as $key => $value) {
            if (!in_array($key, $logos)) {
                Setting::set($key, $value);
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Configurações atualizadas com sucesso!'
            ]);
        }

        return redirect()->back()->with('success', 'Configurações atualizadas com sucesso!');
    }
}
