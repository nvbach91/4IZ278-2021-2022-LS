<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\CompanyStoreRequest;
use App\Models\Company;
use App\Services\Company\CompanyService;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    /**
     * @var CompanyService
     */
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index(): string
    {
        $companies = Company::query()
            ->withCount([
                'positions'
            ])
            ->ofUserId(auth('web')->user()->id)
            ->paginate(15);

        return view('app.company.index', [
            'companies' => $companies
        ]);
    }

    public function create(): string
    {
        return view('app.company.create');
    }

    public function store(CompanyStoreRequest $request): RedirectResponse
    {
        $this->companyService->store($request->toDTO());

        return redirect()->route('app.companies.index')->with('status', [
           'success' => __('status.companies.create.success')
        ]);
    }

    public function show(Company $company): string
    {
        return view('app.company.create');
    }

    public function edit(Company $company): string
    {
        return view('');
    }
}
