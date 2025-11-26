<?php

namespace App\Traits;

trait Activable
{
    /**
     * Toggle the "activo" and "estat" states of a model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  bool  $state
     * @param  string|null  $redirectRoute
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
public function toggleActive($model, bool $state, string $redirectRoute = null)
{
    $changes = [];

    if (array_key_exists('activo', $model->getAttributes())) {
        $changes['activo'] = (int) $state;
    }

    if (array_key_exists('estat', $model->getAttributes())) {
        $changes['estat'] = (int) $state;
    }

    foreach ($changes as $key => $value) {
        $model->setAttribute($key, $value);  // mark field as dirty
    }

    $model->save();

    if ($redirectRoute) {
        return redirect()->route($redirectRoute);
    }

    return back();
}



}
