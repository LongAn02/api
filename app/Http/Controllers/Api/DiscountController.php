<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Response;

class DiscountController extends Controller
{
    protected $discount;

    /**
     * @param Discount $discount
     */
    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = $this->discount->paginate(5);

        $discountResource = DiscountResource::collection($discounts);

       return $this->sentSuccessResponse(
           $discountResource,
           extraDataTransmission: [
               'total' => $this->discount->count()
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
    public function store(DiscountRequest $request)
    {
        $createDiscount = $this->discount->create($request->all());

        $discountResource = new DiscountResource($createDiscount);

        return $this->sentSuccessResponse(
            $discountResource,
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
        $discount = $this->discount->findOrFail($id);

        $discountResource = new DiscountResource($discount);

        return $this->sentSuccessResponse(
            $discountResource,
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
    public function update(DiscountRequest $request, $id)
    {
        $discount = $this->discount->findOrFail($id);

        $discount->update($request->all());

        $discountResource = new DiscountResource($discount);

        return $this->sentSuccessResponse(
            $discountResource,
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
        $discount = $this->discount->findOrFail($id);

        $discount->delete();

        return $this->sentSuccessResponse(
            extraDataTransmission: [
                'message' => 'successfully deleted '.$id
            ],
            status: Response::HTTP_OK
        );
    }
}
