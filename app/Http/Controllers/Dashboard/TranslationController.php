<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TranslationController extends Controller
{
    public function index()
    {
        $data['prefixes'] = Language::active()->Ordered()->get()->pluck('prefix');
        $data['keys'] = file_exists(base_path('lang/temp.json')) ? array_keys(json_decode(file_get_contents(base_path('lang/temp.json')), true)) : [];

        foreach ($data['prefixes'] as $prefix) {
            $data['langs'][$prefix] = file_exists(base_path('lang/' . $prefix . '.json')) ? json_decode(file_get_contents(base_path('lang/' . $prefix . '.json')), true) : [];
        }
        return view('dashboard.pages.translations.list', $data);
    }
    public function store(Request $request)
    {
        try {

            $data = file_exists(base_path('lang/temp.json')) ? json_decode(file_get_contents(base_path('lang/temp.json')), true) : [];
            $data[$request->key] = '';
            file_put_contents(base_path('lang/temp.json'), json_encode($data));
            foreach ($request->langs as $prefix => $value) {
                $data = file_exists(base_path('lang/' . $prefix . '.json')) ? json_decode(file_get_contents(base_path('lang/' . $prefix . '.json')), true) : [];
                $data[$request->key] = $value;
                file_put_contents(base_path('lang/' . $prefix . '.json'), json_encode($data));
            }

            toastr()->success("Translarion Stored sucseefuly");
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $key = $request->key ?? '';
        try {

            $data = file_exists(base_path('lang/temp.json')) ? json_decode(file_get_contents(base_path('lang/temp.json')), true) : [];
            unset($data[$key]);
            file_put_contents(base_path('lang/temp.json'), json_encode($data));

            $data['prefixes'] = Language::active()->Ordered()->get()->pluck('prefix');
            foreach ($data['prefixes'] as $prefix) {
                $data = file_exists(base_path('lang/' . $prefix . '.json')) ? json_decode(file_get_contents(base_path('lang/' . $prefix . '.json')), true) : [];
                unset($data[$key]);
                file_put_contents(base_path('lang/' . $prefix . '.json'), json_encode($data));
            }

            toastr()->success("Translarion deleted sucseefuly");
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
            return redirect()->back();
        }
    }
}
