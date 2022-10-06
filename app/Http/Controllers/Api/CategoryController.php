<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $category;

    /**
     * @param $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->category->all();

        $categoryResource = CategoryResource::collection($category);

        return $this->sentSuccessResponse(
            $categoryResource,
            extraDataTransmission: [
                'total' => $this->category->count()
            ],
            status: Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $categoryCreate = $this->category->create($request->all());

        $categoryResource = new CategoryResource($categoryCreate);

        return $this->sentSuccessResponse(
            $categoryResource,
            status: Response::HTTP_OK
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->findOrFail($id);

        $categoryResource = new CategoryResource($category);

        return $this->sentSuccessResponse(
            $categoryResource,
            status: Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = $this->category->findOrFail($id);

        $category->update($request->all());

        $categoryResource = new CategoryResource($category);

        return $this->sentSuccessResponse(
            $categoryResource,
            status: Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);

        $category->delete();

        return $this->sentSuccessResponse(
            extraDataTransmission: [
                'act' => 'successfully deleted '.$id
            ],
            status: Response::HTTP_OK
        );
    }
}
