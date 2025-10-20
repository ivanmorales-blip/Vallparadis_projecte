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
    $attributesToUpdate = [];

    // Check if attribute keys exist in the model's attributes (database columns)
    if (array_key_exists('activo', $model->getAttributes())) {
        $attributesToUpdate['activo'] = (int) $state;
    }

    if (array_key_exists('estat', $model->getAttributes())) {
        $attributesToUpdate['estat'] = (int) $state;
    }

    if (empty($attributesToUpdate)) {
        \Log::warning('Model does not have "activo" or "estat" attributes.', ['model' => get_class($model)]);
    } else {
        $model->forceFill($attributesToUpdate);
    }

    \Log::info('Model dirty attributes before save:', $model->getDirty());

    try {
        $saved = $model->save();

        \Log::info('Saving model result:', ['saved' => $saved, 'model' => $model->toArray()]);

        if (!$saved) {
            throw new \Exception('Failed to save the model.');
        }
    } catch (\Exception $e) {
        \Log::error('Error saving model in toggleActive: ' . $e->getMessage());
        throw $e;
    }

    if (request()->ajax()) {
        return response()->json([
            'success' => true,
            'activo'  => $model->activo ?? null,
            'estat'   => $model->estat ?? null,
            'id'      => $model->id,
        ]);
    }

    if ($redirectRoute) {
        return redirect()->route($redirectRoute);
    }

    $modelName = strtolower(class_basename($model));
    return redirect()->route($modelName . 's.index');
}


}
