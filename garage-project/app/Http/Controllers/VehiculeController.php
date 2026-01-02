<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $vehicules = Vehicule::all();
            return response()->json([
                'success' => true,
                'data' => $vehicules,
                'message' => 'Véhicules récupérés avec succès'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des véhicules',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate(Vehicule::rules());
            
            $vehicule = Vehicule::create($validatedData);
            
            return response()->json([
                'success' => true,
                'data' => $vehicule,
                'message' => 'Véhicule créé avec succès'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du véhicule',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $vehicule = Vehicule::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $vehicule,
                'message' => 'Véhicule récupéré avec succès'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Véhicule non trouvé',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $vehicule = Vehicule::findOrFail($id);
            
            $rules = Vehicule::rules();
            $rules['immatriculation'] = 'required|string|unique:vehicules,immatriculation,' . $id;
            
            $validatedData = $request->validate($rules);
            
            $vehicule->update($validatedData);
            
            return response()->json([
                'success' => true,
                'data' => $vehicule,
                'message' => 'Véhicule mis à jour avec succès'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du véhicule',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $vehicule = Vehicule::findOrFail($id);
            $vehicule->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Véhicule supprimé avec succès'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du véhicule',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the listing view for vehicles.
     *
     * @return \Illuminate\View\View
     */
    public function liste()
    {
        $vehicules = Vehicule::all();
        return view('vehicules.liste', compact('vehicules'));
    }

    /**
     * Show the form for creating a new vehicle.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vehicules.create');
    }

    /**
     * Show the form for editing the specified vehicle.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('vehicules.edit', compact('vehicule'));
    }

    /**
     * Display the specified vehicle details.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showDetails($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('vehicules.show', compact('vehicule'));
    }
}