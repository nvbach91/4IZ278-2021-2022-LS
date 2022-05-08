<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\User;
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
        /** @var User $user */
        $user = auth('web')->user();

        $companies = Company::query()
            ->withCount([
                'positions',
            ])
            ->ofUserId($user->id)
            ->paginate(15);

        return view('app.company.index', [
            'companies' => $companies,
        ]);
    }

    public function create(): string
    {
        return view('app.company.create');
    }

    public function store(CompanyStoreRequest $request): RedirectResponse
    {
        $this->companyService->storeOrUpdate($request->toDTO());

        return redirect()->route('app.companies.index')->with('status', [
            'success' => __('status.companies.create.success'),
        ]);
    }

    public function show(Company $company): string
    {
        $company->loadCount([
            'positions'
        ]);

        return view('app.company.show', [
            'company' => $company,
        ]);
    }

    public function edit(Company $company): string
    {
        return view('app.company.edit', [
            'company' => $company,
        ]);
    }

    public function update(Company $company, CompanyUpdateRequest $request): RedirectResponse
    {
        $company = $this->companyService->storeOrUpdate($request->toDTO(), $company);

        return redirect()->route('app.companies.show', [
            'company' => $company->id,
        ])->with('status', [
            'success' => __('status.companies.update.success'),
        ]);
    }
}
