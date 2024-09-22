<?php 

namespace App\Repositories;

use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelRepository implements CarModelRepositoryInterface
{
    public function all(Request $request)
    {
        $query = CarModel::query();

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('year_from') && $request->filled('year_to')) {
            $query->whereBetween('year', [$request->year_from, $request->year_to]);
        }

        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        if ($request->filled('engine_id')) {
            $query->where('engine_id', $request->engine_id);
        }

        if ($request->filled('transmission_id')) {
            $query->where('transmission_id', $request->transmission_id);
        }

        if ($request->filled('exterior_color')) {
            $query->where('exterior_color', 'like', '%' . $request->exterior_color . '%');
        }

        if ($request->filled('interior_color')) {
            $query->where('interior_color', 'like', '%' . $request->interior_color . '%');
        }

        return $query->with(['brand', 'engine', 'transmission'])->orderBy('id', 'desc')->paginate(15);
    }
}
