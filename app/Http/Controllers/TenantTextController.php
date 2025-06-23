<?php

namespace App\Http\Controllers;

use App\Models\TenantText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenantTextController extends Controller
{
    public function edit()
    {
        $tenantId = tenant()->id;

        $texts = TenantText::where('tenant_id', $tenantId)
            ->pluck('value', 'key')
            ->toArray();

        return view('tenant.texts.edit', compact('texts'));
    }

    public function update(Request $request)
    {
        $tenant = tenant();

        // Validación personalizada para AJAX
        $rules = [
            'slogan_text' => 'required|string',
            'slogan_body' => 'required|string',
            'about_text' => 'required|string',
            'service1_title' => 'required|string',
            'service1_body' => 'required|string',
            'service2_title' => 'required|string',
            'service2_body' => 'required|string',
            'service3_title' => 'required|string',
            'service3_body' => 'required|string',
            'services_path_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'services_path_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'services_path_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_service_1' => 'required|string',
            'title_service_2' => 'required|string',
            'title_service_3' => 'required|string',
            'body_service_1' => 'required|string',
            'body_service_2' => 'required|string',
            'body_service_3' => 'required|string',
            'about_us' => 'required|string',
            'experience' => 'required|string',
        ];

        if ($request->ajax()) {
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
        } else {
            $request->validate($rules);
        }

        $keys = ['slogan_text', 'slogan_body', 'about_text', 'service1_title', 'service1_body', 'service2_title', 'service2_body', 'service3_title', 'service3_body', 'title_service_1', 'title_service_2', 'title_service_3', 'body_service_1', 'body_service_2', 'body_service_3', 'about_us', 'experience'];

        foreach ($keys as $key) {
            $value = $request->input($key, '');

            TenantText::updateOrCreate(
                ['tenant_id' => $tenant->id, 'key' => $key],
                ['value' => $value]
            );
        }

        if ($request->hasFile('services_path_1')) {
            $file1 = $request->file('services_path_1');
            $filename1 = time() . '_' . $file1->getClientOriginalName();
            $file1->move(public_path('images/services'), $filename1);
            $tenant->services_path_1 = $filename1;
        }

        if ($request->hasFile('services_path_2')) {
            $file2 = $request->file('services_path_2');
            $filename2 = time() . '_' . $file2->getClientOriginalName();
            $file2->move(public_path('images/services'), $filename2);
            $tenant->services_path_2 = $filename2;
        }

        if ($request->hasFile('services_path_3')) {
            $file3 = $request->file('services_path_3');
            $filename3 = time() . '_' . $file3->getClientOriginalName();
            $file3->move(public_path('images/services'), $filename3);
            $tenant->services_path_3 = $filename3;
        }

        if ($request->hasFile('about_path')) {
            $file = $request->file('about_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/about');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $tenant->about_path = $filename;
        }

        if ($request->hasFile('banner_path')) {
            $file = $request->file('banner_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/banner');
            $file->move($destinationPath, $filename);
            $tenant->banner_path = $filename;
        }

        $tenant->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Textos e imágenes actualizados con éxito.');
    }
}
