<?php

namespace App\Http\Controllers;

use App\Models\HardwareCategory;
use App\Models\HardwareItem;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class HardwareController extends Controller
{
    public function index(): View
    {
        $categories = collect();
        $dbError = null;

        try {
            $categories = HardwareCategory::query()
                ->orderBy('name')
                ->get();
        } catch (\Throwable $e) {
            $dbError = 'Database connection is not available yet. Run migrations and seeds, then refresh.';
        }

        return view('hardware.index', [
            'categories' => $categories,
            'dbError' => $dbError,
        ]);
    }

    public function show(string $category, ?int $item_id = null): View
    {
        $dbError = null;
        $categoryModel = null;
        $items = collect();
        $selectedItem = null;

        try {
            $categoryModel = HardwareCategory::query()
                ->where('slug', $category)
                ->firstOrFail();

            $items = HardwareItem::query()
                ->where('hardware_category_id', $categoryModel->id)
                ->orderBy('asset_tag')
                ->get();

            if (! is_null($item_id)) {
                $selectedItem = HardwareItem::query()
                    ->with(['category', 'assignedTo'])
                    ->where('hardware_category_id', $categoryModel->id)
                    ->whereKey($item_id)
                    ->firstOrFail();
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        } catch (\Throwable $e) {
            $dbError = 'Database connection is not available yet. Run migrations and seeds, then refresh.';
        }

        return view('hardware.show', [
            'category' => $category,
            'item_id' => $item_id,
            'categoryModel' => $categoryModel,
            'items' => $items,
            'selectedItem' => $selectedItem,
            'dbError' => $dbError,
        ]);
    }
}
