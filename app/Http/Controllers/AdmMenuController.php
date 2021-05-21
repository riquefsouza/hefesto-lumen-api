<?php

namespace App\Http\Controllers;

use App\Models\AdmMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdmMenuController extends Controller
{
    public function index()
    {
        return AdmMenu::all();
    }

    public function store(Request $request)
    {
        return response()
            ->json(
                AdmMenu::create($request->all()),
                Response::HTTP_CREATED
            );
    }

    public function show(int $id)
    {
        $obj = AdmMenu::find($id);
        if (is_null($obj)) {
            return response()->json('', Response::HTTP_NO_CONTENT);
        }

        return response()->json($obj);
    }

    public function update(int $id, Request $request)
    {
        $obj = AdmMenu::find($id);
        if (is_null($obj)) {
            return response()->json([
                'error' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $obj->fill($request->all());
        $obj->save();

        return $obj;
    }

    public function destroy(int $id)
    {
        $qty = AdmMenu::destroy($id);
        if ($qty === 0) {
            return response()->json([
                'error' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
