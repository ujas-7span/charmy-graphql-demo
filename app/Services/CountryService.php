<?php

namespace App\Services;

use App\Models\Country;
use App\Traits\SortTrait;
use App\Traits\PaginationTrait;

class CountryService
{
    use PaginationTrait, SortTrait;

    private $countryObj;

    public function __construct(Country $countryObj)
    {
        $this->countryObj = $countryObj;
    }
    public function collection($inputs)
    {
        $inputs = $this->paginationAttribute($inputs);

        $countries = $this->countryObj->select(isset($inputs['select']) ? $inputs['select'] : '*');

        if (isset($inputs['with'])) {
            $countries = $countries->with($inputs['with']);
        }
        if (empty($inputs['sort'])) {
            $countries->orderBy('id', 'desc');
        }
        if (isset($inputs['search'])) {
            $countries->search($inputs['search']);
        }
        $this->sortInput($countries, $inputs);

        $inputs['limit'] = $inputs['limit'] == -1 ? $countries->count() : $inputs['limit'];
        $countries = $countries->paginate($inputs['limit'], ['*'], 'page', $inputs['page']);

        return $countries;
    }

    public function resource($id, $inputs = null)
    {
        $country = $this->countryObj->select(isset($inputs['select']) ? $inputs['select'] : '*')->where('id', $id);

        if (isset($inputs['with'])) {
            $country = $country->with($inputs['with']);
        }

        return $country->firstOrFail();
    }
}
