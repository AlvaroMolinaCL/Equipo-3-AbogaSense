<?php

namespace App\Http\Controllers;

use App\Models\LegalCase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CaseUpdated;

class CaseController extends Controller
{
    public function index()
    {
        $tenantId = tenant('id');
        $cases = LegalCase::where('tenant_id', $tenantId)->get();

        // Corrige la vista a la carpeta correcta
        return view('tenants.default.casos.index', compact('cases', 'tenantId'));
    }

    public function create()
    {
        $tenantId = tenant('id');
        $users = User::all();

        return view('tenants.default.casos.create', compact('users', 'tenantId'));
    }

    public function store(Request $request)
    {
        $tenantId = tenant('id');

        $case = LegalCase::create([
            'tenant_id' => $tenantId,
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'pendiente',
        ]);

        if ($case->user) {
            Mail::to($case->user->email)->send(new CaseUpdated($case));
        }

        return redirect()->route('cases.index');
    }

    public function edit(LegalCase $case)
    {
        $tenantId = tenant('id');
        $users = User::all();

        return view('tenants.default.casos.edit', compact('case', 'users', 'tenantId'));
    }

    public function update(Request $request, LegalCase $case)
    {
        $case->update($request->only('user_id', 'title', 'description', 'status'));

        if ($case->user) {
            Mail::to($case->user->email)->send(new CaseUpdated($case));
        }

        return redirect()->route('cases.index');
    }
}
