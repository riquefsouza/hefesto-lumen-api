<?php

namespace App\Http\Controllers;

use App\Models\AdmUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AdmUserService;

class AdmUserController extends Controller
{

    /**
     * @var AdmUserService
     */
    private $service;

    public function __construct(AdmUserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $list = AdmUser::all();
        $this->service->setTransientList($list);

        return $list;
    }

    public function store(Request $request)
    {
        return response()
            ->json(
                AdmUser::create($request->all()),
                Response::HTTP_CREATED
            );
    }

    public function show(int $id)
    {
        $obj = AdmUser::find($id);
        if (is_null($obj)) {
            return response()->json('', Response::HTTP_NO_CONTENT);
        } else {
            $this->service->setTransient($obj);
        }

        return response()->json($obj);
    }

    public function update(int $id, Request $request)
    {
        $obj = AdmUser::find($id);
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
        $qty = AdmUser::destroy($id);
        if ($qty === 0) {
            return response()->json([
                'error' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
