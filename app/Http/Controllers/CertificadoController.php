<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Http\Requests\CertificadoRequest;

/**
 * Class CertificadoController
 * @package App\Http\Controllers
 */
class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificados = Certificado::paginate();

        return view('certificado.index', compact('certificados'))
            ->with('i', (request()->input('page', 1) - 1) * $certificados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $certificado = new Certificado();
        return view('certificado.create', compact('certificado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificadoRequest $request)
    {
        Certificado::create($request->validated());

        return redirect()->route('certificados.index')
            ->with('success', 'Certificado created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $certificado = Certificado::find($id);

        return view('certificado.show', compact('certificado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $certificado = Certificado::find($id);

        return view('certificado.edit', compact('certificado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CertificadoRequest $request, Certificado $certificado)
    {
        $certificado->update($request->validated());

        return redirect()->route('certificados.index')
            ->with('success', 'Certificado updated successfully');
    }

    public function destroy($id)
    {
        Certificado::find($id)->delete();

        return redirect()->route('certificados.index')
            ->with('success', 'Certificado deleted successfully');
    }
}
