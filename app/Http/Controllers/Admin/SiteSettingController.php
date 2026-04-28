<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::first();

        if (! $siteSetting) {
            $siteSetting = SiteSetting::create([
                'site_name' => 'Rajyog Green',
                'site_title' => 'Rajyog Green',
                'status' => 1,
            ]);
        }

        return view('admin.siteSettings.index', compact('siteSetting'));
    }

    public function update(Request $request, SiteSetting $siteSetting)
    {
        $request->validate([
            'site_name'        => 'nullable|string|max:255',
            'site_title'       => 'nullable|string|max:255',
            'tagline'          => 'nullable|string|max:255',

            'email'            => 'nullable|email|max:255',
            'phone'            => 'nullable|string|max:30',
            'alternate_phone'  => 'nullable|string|max:30',
            'whatsapp_number'  => 'nullable|string|max:30',

            'address'          => 'nullable|string',
            'map_url'          => 'nullable|string',

            'facebook_url'     => 'nullable|string|max:255',
            'instagram_url'    => 'nullable|string|max:255',
            'twitter_url'      => 'nullable|string|max:255',
            'linkedin_url'     => 'nullable|string|max:255',
            'youtube_url'      => 'nullable|string|max:255',

            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',

            'copyright_text'   => 'nullable|string|max:255',

            'logo'             => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'footer_logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'favicon'          => 'nullable|image|mimes:jpg,jpeg,png,webp,svg,ico|max:1024',

            'status'           => 'nullable|boolean',
        ]);

        $siteSetting->update([
            'site_name'        => $request->site_name,
            'site_title'       => $request->site_title,
            'tagline'          => $request->tagline,

            'email'            => $request->email,
            'phone'            => $request->phone,
            'alternate_phone'  => $request->alternate_phone,
            'whatsapp_number'  => $request->whatsapp_number,

            'address'          => $request->address,
            'map_url'          => $request->map_url,

            'facebook_url'     => $request->facebook_url,
            'instagram_url'    => $request->instagram_url,
            'twitter_url'      => $request->twitter_url,
            'linkedin_url'     => $request->linkedin_url,
            'youtube_url'      => $request->youtube_url,

            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,

            'copyright_text'   => $request->copyright_text,

            'status'           => $request->has('status') ? 1 : 0,
        ]);

        if ($request->hasFile('logo')) {
            $siteSetting
                ->addMediaFromRequest('logo')
                ->toMediaCollection('logo');
        }

        if ($request->hasFile('footer_logo')) {
            $siteSetting
                ->addMediaFromRequest('footer_logo')
                ->toMediaCollection('footer_logo');
        }

        if ($request->hasFile('favicon')) {
            $siteSetting
                ->addMediaFromRequest('favicon')
                ->toMediaCollection('favicon');
        }

        return redirect()
            ->route('admin.site-settings.index')
            ->with('success', 'Site setting updated successfully.');
    }

    public function destroyLogo(SiteSetting $siteSetting)
    {
        $siteSetting->clearMediaCollection('logo');

        return back()->with('success', 'Logo deleted successfully.');
    }

    public function destroyFooterLogo(SiteSetting $siteSetting)
    {
        $siteSetting->clearMediaCollection('footer_logo');

        return back()->with('success', 'Footer logo deleted successfully.');
    }

    public function destroyFavicon(SiteSetting $siteSetting)
    {
        $siteSetting->clearMediaCollection('favicon');

        return back()->with('success', 'Favicon deleted successfully.');
    }
}