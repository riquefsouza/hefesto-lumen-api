<?php

namespace App\Http\Controllers;

use App\Models\AdmMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AdmMenuService;

class AdmMenuController extends Controller
{

    /**
     * @var AdmMenuService
     */
    private $service;

    public function __construct(AdmMenuService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $list = AdmMenu::all();
        $this->service->setTransientList($list);

        return $list;
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
        } else {
            $this->service->setTransient($obj);
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

    public function mountMenu(Request $request)
    {
        $listaIdProfile = $request->all();
        $menuItens = $this->service->mountMenuItem($listaIdProfile);

        //return response()->json($menuItens);
        return collect($menuItens);
    }
}
