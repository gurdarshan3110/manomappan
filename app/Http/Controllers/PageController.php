<?php

namespace App\Http\Controllers;

use App\Helpers\CareerSectionRenderer;
use App\Traits\HasNavigationMenu;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Career;
use App\Models\CareerCluster;

class PageController extends Controller
{
    use HasNavigationMenu;

    public function __construct()
    {
        // Share navigation menu with all views
        view()->share('navigationMenu', $this->getNavigationMenu());
    }

    public function home()
    {
        $meta = config('metatags.home');
        $packages = Package::isActive()->with(['tests' => function ($query) {
            $query->where('activated', true)->orderBy('display_name');
        }])->get();
        return view('pages.home', compact('meta', 'packages'));
    }

    public function login(Request $request)
    {
        $meta = config('metatags.login');
        
        // Store redirect URL in session if provided
        $redirectUrl = $request->get('redirect_url');
        if ($redirectUrl) {
            session(['redirect_url' => $redirectUrl]);
        }
        
        return view('pages.login', compact('meta'));
    }

    public function register(Request $request)
    {
        $meta = config('metatags.register');
        
        // Store redirect URL in session if provided
        $redirectUrl = $request->get('redirect_url');
        if ($redirectUrl) {
            session(['redirect_url' => $redirectUrl]);
        }
        
        return view('pages.register', compact('meta'));
    }

    public function about()
    {
        $meta = config('metatags.about');
        return view('pages.about', compact('meta'));
    }

    public function contact()
    {
        $meta = config('metatags.contact');
        return view('pages.contact', compact('meta'));
    }

    public function forgotPassword()
    {
        $meta = config('metatags.forgot_password');
        return view('pages.forgot_password', compact('meta'));
    }

    public function buyPackage(Request $request, $id = null)
    {
        $meta = config('metatags.buy_package', [
            'title' => 'Buy Package - Choose Your Career Plan',
            'description' => 'Select the perfect career counselling package for your journey'
        ]);
        
        $packages = Package::isActive()->with(['tests' => function ($query) {
            $query->where('activated', true)->orderBy('display_name');
        }])->get();
        
        // Set selected package if ID is provided
        $selectedPackageId = $id ?? ($packages->first()->id ?? null);
        $selectedPackage = $packages->firstWhere('id', $selectedPackageId);
        
        return view('pages.buy-package', compact('meta', 'packages', 'selectedPackageId', 'selectedPackage'));
    }

    public function payment(Request $request)
    {
        $meta = config('metatags.payment', [
            'title' => 'Payment - Complete Your Purchase',
            'description' => 'Complete your career counselling package purchase securely'
        ]);
        
        $packageId = $request->get('package_id');
        $selectedPackage = null;
        
        if ($packageId) {
            $selectedPackage = Package::isActive()->with(['tests' => function ($query) {
                $query->where('activated', true)->orderBy('display_name');
            }])->find($packageId);
        }
        
        return view('pages.payment', compact('meta', 'selectedPackage'));
    }

    public function cluster($slug)
    {
        $cluster = CareerCluster::where('slug', $slug)
            ->where('status', CareerCluster::STATUS_PUBLISHED)
            ->firstOrFail();

        $careers = Career::where('cluster_id', $cluster->id)
            ->where('status', Career::STATUS_PUBLISHED)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $meta = [
            'title' => $cluster->seo_title ?? $cluster->name,
            'description' => $cluster->seo_description,
        ];

        return view('pages.cluster', compact('meta', 'cluster', 'careers'));
    }

    public function career($clusterSlug, $careerSlug)
    {
        $career = Career::whereHas('cluster', function ($query) use ($clusterSlug) {
                $query->where('slug', $clusterSlug)
                    ->where('status', CareerCluster::STATUS_PUBLISHED);
            })
            ->where('slug', $careerSlug)
            ->where('status', Career::STATUS_PUBLISHED)
            ->with(['sections' => function ($query) {
                $query->orderBy('section_order');
            }])
            ->firstOrFail();

        // Get all rendered sections using our helper
        $sections = CareerSectionRenderer::getAllSections($career);
        
        // Organize sections by type for easy access in the view
        $sectionsByType = [];
        foreach ($sections as $section) {
            $sectionsByType[$section['type']] = $section;
        }

        $meta = [
            'title' => $career->seo_title ?? $career->title,
            'description' => $career->seo_description,
            'keywords' => $career->meta_keywords,
        ];

        return view('pages.career', compact('meta', 'career', 'sections', 'sectionsByType'));
    }
}
