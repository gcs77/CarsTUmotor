<?php

namespace App\Http\Controllers;

use App\Services\DashboardEjecutivoService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __construct(
        private DashboardEjecutivoService $dashboardService
    ) {}

    public function ejecutivo(): JsonResponse
    {
        $kpis = $this->dashboardService->obtenerKPIs();

        return response()->json($kpis);
    }
}
