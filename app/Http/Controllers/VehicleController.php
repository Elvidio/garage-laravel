<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use App\Services\CannotReservedVehicleLockedException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\ReservedVehicleRequest;
use App\Services\UserHasNotEnoughMoneyException;

class VehicleController extends Controller
{
    /**
     * @var \App\Services\VehicleService
     */
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index(Request $request)
    {
        $vehicles = Vehicle::with('brand')->get();

        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    public function create()
    {
        $brands = Brand::all();

        return view('vehicles.create', ['brands' => $brands]);
    }

    public function store(CreateVehicleRequest $request): RedirectResponse
    {
        $this->vehicleService->saveVehicle(
            $request->get('brand_id'),
            $request->get('name'),
            $request->get('price'),
            $request->get('status'),
            $request->get('odometer'),
            $request->get('type')
          );

        return redirect()->route('vehicles.create');
    }

    public function reserved($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('vehicles.reserved', ['vehicle' => $vehicle]);
    }

    public function storeReserved(ReservedVehicleRequest $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $user = Auth::user();

        try {
            $this->vehicleService->reserved($vehicle, $user, $request->all());

            return redirect('/');
        } catch (UserHasNotEnoughMoneyException $exception) {
            return back()->withErrors(['error' => "Vous n'avez pas asser d'argent pour louer cette voiture sur cette durée"]);
        } catch(CannotReservedVehicleLockedException $exception) {
            return back()->withErrors(['error' => 'Le véhicule ne peut pas être reservé pendant cette période']);
        }
    }

    public function booking()
    {
        $vehicles = Vehicle::all();

        return view('vehicles.booking', ['vehicles' => $vehicles]);
    }

    public function calcul(Request $request)
    {

        $vehicle = Vehicle::findOrFail($request->get('vehicle_id'));
        $started = $request->get('starting_at');
        $ended= $request->get('ending_at');

        $startingAt = Carbon::parse($started);

        $days = $startingAt->diffInDays($ended);

        $prixHT = ($days + 1) * $vehicle->price;

        $prixTTC = $prixHT * 1.2;

        return view('vehicles.devis', ['vehicle' => $vehicle, 'prixTTC' => $prixTTC, 'prixHT' => $prixHT, 'started' => $started, 'ended' => $ended, 'days' => $days]);

    }

    public function prolonger(Request $request, $id)
    {
        $vehicle= Vehicle::findOrFail($id);
        $end = $vehicle->update([
            'ending_at'
        ]);

        return view ('vehicles.prolonger', [ 'end' => $end, 'id' => $id]);
    }

}
