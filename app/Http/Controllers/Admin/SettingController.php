<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        // Fetch all settings from the database
        $settings = Setting::all()->keyBy('key'); // Key by 'key' for easy access in view (e.g., $settings['logo']->value)
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified settings in storage.
     */
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', // Logo is optional, but if present, must be an image
            'phone_number' => 'nullable|string|max:255',
            'email_address' => 'nullable|email|max:255',
            'company_address' => 'nullable|string|max:255',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $newLogo = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $newLogo->extension();
            $uploadPath = 'uploads/settings'; // Directory inside public/

            // Get the old logo path from the database
            $oldLogoSetting = Setting::where('key', 'logo')->first();
            if ($oldLogoSetting && $oldLogoSetting->value && File::exists(public_path($oldLogoSetting->value))) {
                // Delete the old logo file if it exists and is not the default theme logo
                // Add a check to prevent deleting default theme assets if they are not in 'uploads'
                if (str_starts_with($oldLogoSetting->value, $uploadPath)) {
                     File::delete(public_path($oldLogoSetting->value));
                }
            }

            // Move the new logo file
            $newLogo->move(public_path($uploadPath), $logoName);
            $logoPath = $uploadPath . '/' . $logoName;

            // Update the logo setting in the database
            Setting::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $logoPath, 'type' => 'image']
            );
        }

        // Update other text settings
        Setting::updateOrCreate(
            ['key' => 'phone_number'],
            ['value' => $request->input('phone_number'), 'type' => 'text']
        );

        Setting::updateOrCreate(
            ['key' => 'email_address'],
            ['value' => $request->input('email_address'), 'type' => 'text']
        );

        Setting::updateOrCreate(
            ['key' => 'company_address'],
            ['value' => $request->input('company_address'), 'type' => 'text']
        );

        session()->flash('success', 'Website settings updated successfully!');
        return redirect()->route('admin.settings.index');
    }
}
