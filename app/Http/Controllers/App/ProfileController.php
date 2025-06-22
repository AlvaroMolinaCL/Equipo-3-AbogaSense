<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $genres = \App\Models\Genre::all();
        $regions = \App\Models\Region::all();
        $communes = \App\Models\Commune::all();

        if (tenant()) {
            return view(tenantView('profile.edit'), [
                'user' => $user,
                'genres' => $genres,
                'regions' => $regions,
                'communes' => $communes,
            ]);
        } else {
            return view('profile.edit', [
                'user' => $user,
                'genres' => $genres,
                'regions' => $regions,
                'communes' => $communes,
            ]);
        }
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
    
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        $request->user()->save();
    
        if ($request->ajax()) {
            return response()->json(['success' => 'Perfil actualizado con éxito.']);
        }
    
        return Redirect::route('profile.edit')->with('success', 'Perfil actualizado con éxito.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
