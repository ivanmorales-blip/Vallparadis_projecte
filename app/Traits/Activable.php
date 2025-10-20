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
    // Set the properties
    if (property_exists($model, 'activo')) {
        $model->activo = $state;
    }

    if (property_exists($model, 'estat')) {
        $model->estat = $state;
    }

    try {
        $saved = $model->save();

        // Log the result for debugging
        \Log::info('Saving model result:', ['saved' => $saved, 'model' => $model->toArray()]);

        if (!$saved) {
            throw new \Exception('Failed to save the model.');
        }
    } catch (\Exception $e) {
        // Log the error message
        \Log::error('Error saving model in toggleActive: ' . $e->getMessage());

        // Optionally rethrow or handle the exception depending on your app
        throw $e;
    }

    // Handle AJAX request
    if (request()->ajax()) {
        return response()->json([
            'success' => true,
            'activo'  => $model->activo ?? null,
            'estat'   => $model->estat ?? null,
            'id'      => $model->id,
        ]);
    }

    // Redirect to a given route or infer automatically
    if ($redirectRoute) {
        return redirect()->route($redirectRoute);
    }

    $modelName = strtolower(class_basename($model));
    return redirect()->route($modelName . 's.index');
}

}
