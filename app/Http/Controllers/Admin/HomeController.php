<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\AuditLog;
use App\Models\Enquiry;
use App\Models\Brand;
use App\Models\HeroSection;
use App\Models\ManufactureSection;
use App\Models\Faq;
use App\Models\Certificate;
use App\Models\AboutSection;
use App\Models\OurStorySection;

class HomeController
{
    public function index()
    {
        $stats = [
            'users' => [
                'total' => User::count(),
                'active' => User::count(), // All users are considered active since no status field
            ],
            'roles' => [
                'total' => Role::count(),
            ],
            'permissions' => [
                'total' => Permission::count(),
            ],
            'audit_logs' => [
                'total' => AuditLog::count(),
            ],
            'enquiries' => [
                'total' => Enquiry::count(),
                'unread' => Enquiry::where('is_read', 0)->count(),
                'pending' => Enquiry::where('status', 'pending')->count(),
            ],
            'brands' => [
                'total' => Brand::count(),
                'active' => Brand::where('status', 1)->count(),
            ],
            'hero_sections' => [
                'total' => HeroSection::count(),
                'active' => HeroSection::where('status', 1)->count(),
            ],
            'manufacture_sections' => [
                'total' => ManufactureSection::count(),
                'active' => ManufactureSection::where('status', 1)->count(),
            ],
            'faqs' => [
                'total' => Faq::count(),
                'active' => Faq::where('status', 1)->count(),
            ],
            'certificates' => [
                'total' => Certificate::count(),
                'active' => Certificate::where('status', 1)->count(),
            ],
            'about_sections' => [
                'total' => AboutSection::count(),
                'active' => AboutSection::where('status', 1)->count(),
            ],
            'our_story_sections' => [
                'total' => OurStorySection::count(),
                'active' => OurStorySection::where('status', 1)->count(),
            ],
        ];

        $recentUsers = User::with('roles')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentEnquiries = Enquiry::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Chart data for last 7 days
        $chartData = [
            'enquiries_last_7_days' => $this->getEnquiriesLast7Days(),
            'enquiry_status_distribution' => $this->getEnquiryStatusDistribution(),
            'content_sections_overview' => $this->getContentSectionsOverview(),
            'user_registrations_last_7_days' => $this->getUserRegistrationsLast7Days(),
        ];

        return view('home', compact('stats', 'recentUsers', 'recentEnquiries', 'chartData'));
    }

    private function getEnquiriesLast7Days()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $count = Enquiry::whereDate('created_at', $date)->count();
            $data[] = $count;
        }
        return $data;
    }

    private function getEnquiryStatusDistribution()
    {
        $statuses = [
            'new' => Enquiry::where('status', 'new')->count(),
            'in_progress' => Enquiry::where('status', 'in_progress')->count(),
            'completed' => Enquiry::where('status', 'completed')->count(),
            'cancelled' => Enquiry::where('status', 'cancelled')->count(),
        ];
        return $statuses;
    }

    private function getContentSectionsOverview()
    {
        return [
            'brands' => Brand::where('status', 1)->count(),
            'hero_sections' => HeroSection::where('status', 1)->count(),
            'manufacture_sections' => ManufactureSection::where('status', 1)->count(),
            'faqs' => Faq::where('status', 1)->count(),
            'certificates' => Certificate::where('status', 1)->count(),
            'about_sections' => AboutSection::where('status', 1)->count(),
            'our_story_sections' => OurStorySection::where('status', 1)->count(),
        ];
    }

    private function getUserRegistrationsLast7Days()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $count = User::whereDate('created_at', $date)->count();
            $data[] = $count;
        }
        return $data;
    }
}
