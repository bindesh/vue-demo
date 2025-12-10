<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminCompanyController extends Controller
{
    protected CompanyService $companyService;

    /**
     * Constructor to inject CompanyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of companies in admin panel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $perPage = $request->get('per_page', 10);
        $companies = $this->companyService->getAllCompanies($perPage);

        // Build pagination links
        $links = [];
        $currentPage = $companies->currentPage();
        $lastPage = $companies->lastPage();
        
        // Previous link
        $links[] = [
            'url' => $currentPage > 1 ? $companies->url($currentPage - 1) : null,
            'label' => 'Previous',
            'active' => false,
        ];
        
        // Show page numbers (max 7 pages: current ± 3)
        $start = max(1, $currentPage - 3);
        $end = min($lastPage, $currentPage + 3);
        
        // First page if not in range
        if ($start > 1) {
            $links[] = [
                'url' => $companies->url(1),
                'label' => '1',
                'active' => false,
            ];
            if ($start > 2) {
                $links[] = [
                    'url' => null,
                    'label' => '...',
                    'active' => false,
                ];
            }
        }
        
        // Page number links
        for ($i = $start; $i <= $end; $i++) {
            $links[] = [
                'url' => $companies->url($i),
                'label' => (string) $i,
                'active' => $i === $currentPage,
            ];
        }
        
        // Last page if not in range
        if ($end < $lastPage) {
            if ($end < $lastPage - 1) {
                $links[] = [
                    'url' => null,
                    'label' => '...',
                    'active' => false,
                ];
            }
            $links[] = [
                'url' => $companies->url($lastPage),
                'label' => (string) $lastPage,
                'active' => false,
            ];
        }
        
        // Next link
        $links[] = [
            'url' => $currentPage < $lastPage ? $companies->url($currentPage + 1) : null,
            'label' => 'Next',
            'active' => false,
        ];

        return Inertia::render('Admin/Company/Index', [
            'companies' => CompanyResource::collection($companies->items())->resolve(),
            'pagination' => [
                'current_page' => $companies->currentPage(),
                'last_page' => $companies->lastPage(),
                'per_page' => $companies->perPage(),
                'total' => $companies->total(),
                'from' => $companies->firstItem(),
                'to' => $companies->lastItem(),
                'links' => $links,
            ],
        ]);
    }

    /**
     * Display the specified company details with slider.
     *
     * @param Company $company
     * @return Response
     */
    public function show(Company $company): Response
    {
        $company = $this->companyService->getCompanyById($company)->resolve();

        return Inertia::render('Admin/Company/Show', compact('company'));
    }
}
