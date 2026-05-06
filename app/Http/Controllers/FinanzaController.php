<?php

namespace App\Http\Controllers;

use App\Http\Requests\Finanza\StoreTransaccionRequest;
use App\Services\FinanzaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FinanzaController extends Controller
{
    public function __construct(
        private FinanzaService $finanzaService
    ) {}

    public function storeTransaccion(StoreTransaccionRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $transaccion = $this->finanzaService->registrarTransaccion($data);

        return response()->json($transaccion, 201);
    }

    public function listarInformes(): JsonResponse
    {
        $informes = $this->finanzaService->listarInformes();

        return response()->json($informes);
    }

    public function flujoCaja(Request $request): JsonResponse
    {
        $request->validate([
            'inicio' => ['required', 'date'],
            'fin' => ['required', 'date', 'after_or_equal:inicio'],
        ]);

        $flujo = $this->finanzaService->obtenerFlujoCaja(
            $request->input('inicio'),
            $request->input('fin')
        );

        return response()->json($flujo);
    }

    public function estadoResultados(Request $request): JsonResponse
    {
        $request->validate([
            'inicio' => ['required', 'date'],
            'fin' => ['required', 'date', 'after_or_equal:inicio'],
        ]);

        $estado = $this->finanzaService->obtenerEstadoResultados(
            $request->input('inicio'),
            $request->input('fin')
        );

        return response()->json($estado);
    }

    public function cuentasPorPagar(): JsonResponse
    {
        return response()->json($this->finanzaService->obtenerCuentasPorPagar());
    }

    public function cuentasPorCobrar(): JsonResponse
    {
        return response()->json($this->finanzaService->obtenerCuentasPorCobrar());
    }

    public function subirInforme(Request $request): JsonResponse
    {
        $request->validate([
            'tipo' => ['required', 'string', 'max:50'],
            'periodo' => ['required', 'string', 'max:20'],
            'archivo' => ['required', 'file', 'max:10240'],
        ]);

        $archivo = $request->file('archivo');
        $ruta = $archivo->store('informes');

        $informe = $this->finanzaService->subirInforme([
            'user_id' => auth()->id(),
            'tipo' => $request->input('tipo'),
            'periodo' => $request->input('periodo'),
            'nombre_archivo' => $archivo->getClientOriginalName(),
            'ruta' => $ruta,
        ]);

        return response()->json($informe, 201);
    }
}
