<?php

namespace App\Services;

use App\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyService
{
    /**
     * Get all companies with pagination
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllCompanies(int $perPage = 10)
    {
        return Company::paginate($perPage);
    }

    /**
     * Get a single company by ID
     *
     * @param Company $company
     * @return CompanyResource
     */
    public function getCompanyById(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * Create a new company
     *
     * @param array $data
     * @return CompanyResource
     */
    public function createCompany(array $data): CompanyResource
    {
        return new CompanyResource(Company::create($data));
    }

    /**
     * Update an existing company
     *
     * @param Company $company
     * @param array $data
     * @return CompanyResource
     */
    public function updateCompany(Company $company, array $data): CompanyResource
    {
        $company->update($data);
        return new CompanyResource($company->fresh());
    }

    /**
     * Delete a company
     *
     * @param Company $company
     * @return bool
     */
    public function deleteCompany(Company $company): bool
    {
        return $company->delete();
    }

    /**
     * Get companies by industry
     *
     * @param string $industry
     * @return AnonymousResourceCollection
     */
    public function getCompaniesByIndustry(string $industry): AnonymousResourceCollection
    {
        return CompanyResource::collection(
            Company::where('industry', $industry)->get()
        );
    }

    /**
     * Search companies by name
     *
     * @param string $searchTerm
     * @return AnonymousResourceCollection
     */
    public function searchCompanies(string $searchTerm): AnonymousResourceCollection
    {
        return CompanyResource::collection(
            Company::where('name', 'like', "%{$searchTerm}%")
                ->orWhere('description', 'like', "%{$searchTerm}%")
                ->get()
        );
    }
}
