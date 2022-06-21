<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $request
     * @param $models
     * @param $relationships
     * @return void
     */
    public function setRequestRelationships($request, $models, $relationships): void
    {
        $includes = $this->getRequestIncludes($request);
        foreach ($includes as $include) {
            collect($relationships)->map(function ($relationship) use ($models, $include) {
                return $include === $relationship ? $models->load($relationship) : $models;
            });
        }
    }

    /**
     * @param $request
     * @param $relationships
     * @return array|array[]
     */
    public function checkRequestRelationshipErrors($request, $relationships)
    {
        $includes = $this->getRequestIncludes($request);
        $errors = ['errors' => []];
        foreach ($includes as $include) {
            if (!in_array($include, $relationships)) {
                $errors['errors'][] = [
                    'title' => 'Given data was invalid',
                    'details' => 'Parameter include ' . $include . ' is not valid'
                ];
            }
        }
        return $errors;
    }

    public function getRequestIncludes($request): array
    {
        return explode(',', $request->input('include'));
    }


}
