<?php

namespace App\Http\Controllers;

use App\Models\AdmProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AdmProfileService;

class AdmProfileController extends Controller
{

    /**
     * @var AdmProfileService
     */
    private $service;

    public function __construct(AdmProfileService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $list = AdmProfile::all();
        $this->service->setTransientList($list);

        return $list;
    }

    public function store(Request $request)
    {
        return response()
            ->json(
                AdmProfile::create($request->all()),
                Response::HTTP_CREATED
            );
    }

    public function show(int $id)
    {
        $obj = AdmProfile::find($id);
        if (is_null($obj)) {
            return response()->json('', Response::HTTP_NO_CONTENT);
        } else {
            $this->service->setTransient($obj);
        }

        return response()->json($obj);
    }

    public function update(int $id, Request $request)
    {
        $obj = AdmProfile::find($id);
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
        $qty = AdmProfile::destroy($id);
        if ($qty === 0) {
            return response()->json([
                'error' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json('', Response::HTTP_NO_CONTENT);
    }

    public function findProfilesByPage(int $pageId)
    {
        $admProfileList = $this->service->findProfilesByPage($pageId);
        //return response()->json($admProfileList);
        return collect($admProfileList);
    }

    public function findProfilesByUser(int $userId)
    {
        $admProfileList = $this->service->findProfilesByUser($userId);
        //return response()->json($admProfileList);
        return collect($admProfileList);
    }
}
