<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $categoriesCount = Category::query()
            ->count();
        $workersCount = User::query()
            ->role(Role::WORKER->value)
            ->count();
        $servicesCount = Service::query()
            ->count();
        $offersCount = Offer::query()
            ->count();
        $activeOffersCount = Offer::query()
            ->whereDate('end_date', '>=', now())
            ->count();
        $inactiveOffersCount = Offer::query()
            ->whereDate('end_date', '<', now())
            ->count();

        $categoriesWithUsersCount = Service::query()
            ->select('category_id', DB::raw('count(DISTINCT service_user.user_id) as user_count'))
            ->join('service_user', 'service_user.service_id', '=', 'services.id')
            ->whereHas('users')
            ->groupBy('category_id')
            ->with('category')
            ->get();

        return sendSuccessResponse(data: [
            'workers_count' => $workersCount,
            'categories_count' => $categoriesCount,
            'services_count' => $servicesCount,
            'offers_count' => $offersCount,
            'active_offers_count' => $activeOffersCount,
            'inactive_offers_count' => $inactiveOffersCount,
            'categories_users_count' => $categoriesWithUsersCount,
        ]);
    }
}
