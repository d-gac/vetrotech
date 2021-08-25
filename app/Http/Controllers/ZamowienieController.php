<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZamowienieRequest;
use App\Models\Zamowienie;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ZamowienieController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Zamówienie",
     *     description="Zarządzanie zamówieniami",
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/zamowienie",
     *     tags={"Zamówienie"},
     *     summary="Wyświetl listę zamówień",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   ),
     *
     * )
     */

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Zamowienie::with('product')
            ->with('contractor')
            ->with('dimensions')
            ->with('typeOfGlass')
            ->with('nameOfGlass')
            ->with('numberDepartment')
            ->get();
    }


    /**
     * @OA\Post (
     *     path="/api/zamowienie",
     *     tags={"Zamówienie"},
     *     summary="Dodaj zamówienie",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *     oneOf={
     *      @OA\Schema(type="boolean")
     *           }
     *      ),
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="An ""unexpected"" error"
     *      ),
     *
     *     @OA\RequestBody(
     *
     *        @OA\JsonContent(
     *             type="object",
     *                      @OA\Property(
     *                         property="admissionDate",
     *                         type="string",
     *                         example="2021-01-05"
     *                      ),
     *                      @OA\Property(
     *                         property="receiptDate",
     *                         type="string",
     *                         example="2021-01-06"
     *                      ),
     *                      @OA\Property(
     *                         property="product_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="contractor_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="dimensions_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="width",
     *                         type="integer",
     *                         example="35"
     *                      ),
     *                      @OA\Property(
     *                         property="height",
     *                         type="integer",
     *                         example="15"
     *                      ),
     *                      @OA\Property(
     *                         property="thickness",
     *                         type="integer",
     *                         example="8"
     *                      ),
     *                      @OA\Property(
     *                         property="typeOfGlass_id",
     *                         type="integer",
     *                         example="2"
     *                      ),
     *                      @OA\Property(
     *                         property="nameOfGlass_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="treatment",
     *                         type="string",
     *                         example="Obróbka termiczna"
     *                      ),
     *                      @OA\Property(
     *                         property="quantity",
     *                         type="integer",
     *                         example="10"
     *                      ),
     *                      @OA\Property(
     *                         property="amount",
     *                         type="integer",
     *                         example="200"
     *                      ),
     *                      @OA\Property(
     *                         property="numberDepartment_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="comments",
     *                         type="string",
     *                         example="Uwag brak! Uwag brak! Uwag brak! Uwag brak!"
     *                      ),
     *
     *        )
     *     ),
     * )
     */

    /**
     * @param ZamowienieRequest $request
     *
     * @return Zamowienie
     */
    public function store(ZamowienieRequest $request):Zamowienie
    {
        $newItem = new Zamowienie;

        $dt = Carbon::parse();
        $actualMonth = $dt->month; //symulacja miesiecy
        $actualYear = $dt->year; //symulacja lat
        $lastUsedMonth =  Zamowienie::latest('month')->pluck('month')->first();
        $lastUsedYear =  Zamowienie::latest('year')->pluck('year')->first();

        if ($actualMonth == $lastUsedMonth || $actualYear == $lastUsedYear){ //jeśli miesiac i rok z ostatniego rekordu w bazie sa równe obecnemu miesiacowi i rokowi to tworzy nowy numer umowy z tym samym miesiacem i rokiem

            $maxNumber = Zamowienie::where('month', $actualMonth)
                ->where('year', $actualYear)
                ->max('number');

            if ($maxNumber){
                $number = $maxNumber;
            }else{
                $number = 0;
            }

            $newItem->number = ++$number; // zwiększenie numeru o jeden

        } else
        {
            $number = 0;
            $newItem->number = ++$number; // zwiększenie numeru o jeden

        }

        $newItem->month = $actualMonth; //aktualny miesiac
        $newItem->year = $actualYear; //aktualny rok
        $newItem->orderNumber = $number."/".$actualMonth."/".$actualYear; //pełna nazwa
        $newItem->admissionDate = $request->get("admissionDate");
        $newItem->receiptDate = $request->get("receiptDate");
        $newItem->product_id = $request->get("product_id");
        $newItem->contractor_id = $request->get("contractor_id");
        $newItem->dimensions_id = $request->get("dimensions_id");
        $newItem->width = $request->get("width");
        $newItem->height = $request->get("height");
        $newItem->thickness = $request->get("thickness");
        $newItem->typeOfGlass_id = $request->get("typeOfGlass_id");
        $newItem->nameOfGlass_id = $request->get("nameOfGlass_id");
        $newItem->treatment = $request->get("treatment");
        $newItem->quantity = $request->get("quantity");
        $newItem->amount = $request->get("amount");
        $newItem->numberDepartment_id = $request->get("numberDepartment_id");
        $newItem->comments = $request->get("comments");
        $newItem->save();

        return $newItem;
    }


    /**
     * @OA\Get(
     *     path="/api/zamowienie/{id}",
     *     tags={"Zamówienie"},
     *     summary="Wyświetl zamówienie",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="An ""unexpected"" error"
     *      ),
     *
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * )
     */


    /**
     * @param int $id
     *
     * @return Zamowienie
     */
    public function show(int $id): Zamowienie
    {
            return Zamowienie::findOrFail($id)
                ->where('id', $id)
                ->with('product')
                ->with('contractor')
                ->with('dimensions')
                ->with('typeOfGlass')
                ->with('nameOfGlass')
                ->with('numberDepartment')
                ->first();
    }


    /**
     * @OA\Put(
     *     path="/api/zamowienie/{id}",
     *     tags={"Zamówienie"},
     *     summary="Edytuj zamówienie",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *     oneOf={
     *      @OA\Schema(type="boolean")
     *           }
     *      ),
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *      ),
     *
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *        @OA\JsonContent(
     *             type="object",
     *                      @OA\Property(
     *                         property="admissionDate",
     *                         type="string",
     *                         example="2021-01-05"
     *                      ),
     *                      @OA\Property(
     *                         property="receiptDate",
     *                         type="string",
     *                         example="2021-01-06"
     *                      ),
     *                      @OA\Property(
     *                         property="product_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="contractor_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="dimensions_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="width",
     *                         type="integer",
     *                         example="35"
     *                      ),
     *                      @OA\Property(
     *                         property="height",
     *                         type="integer",
     *                         example="15"
     *                      ),
     *                      @OA\Property(
     *                         property="thickness",
     *                         type="integer",
     *                         example="8"
     *                      ),
     *                      @OA\Property(
     *                         property="typeOfGlass_id",
     *                         type="integer",
     *                         example="2"
     *                      ),
     *                      @OA\Property(
     *                         property="nameOfGlass_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="treatment",
     *                         type="string",
     *                         example="Obróbka termiczna"
     *                      ),
     *                      @OA\Property(
     *                         property="quantity",
     *                         type="integer",
     *                         example="10"
     *                      ),
     *                      @OA\Property(
     *                         property="amount",
     *                         type="integer",
     *                         example="200"
     *                      ),
     *                      @OA\Property(
     *                         property="numberDepartment_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="comments",
     *                         type="string",
     *                         example="Uwag brak! Uwag brak! Uwag brak! Uwag brak!"
     *                      ),
     *        ),
     *     ),
     * )
     */

    /**
     * @param ZamowienieRequest $request
     * @param int $id
     *
     * @return Zamowienie
     */
    public function update(ZamowienieRequest $request, int $id):Zamowienie
    {
        $newItem = Zamowienie::find($id);
        $newItem->update($request->all());
        return $newItem;
    }


    /**
     * @OA\Delete(
     *     path="/api/zamowienie/{id}",
     *     tags={"Zamówienie"},
     *     summary="Usuń zamówienie",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *      ),
     *
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * )
     */

    /**
     * @param int $id
     *
     * @return Zamowienie
     */
    public function destroy(int $id):String
    {
        if (Zamowienie::find($id)) {
            Zamowienie::destroy($id);
            return "Pomyślnie usunięto zamówienie (ID: " . $id . ")";
        } else {
            return "Zamówienie (ID: " . $id . ") nie istnieje";
        }
    }

    /**
     * @OA\Tag(
     *     name="Usunięte zamówienia",
     *     description="Zarządzanie usuniętymi zamówieniami",
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/zamowienie/allOrder",
     *     tags={"Usunięte zamówienia"},
     *     summary="Lista wszystkich utworzonych zamówień",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *      ),
     * )
     */


    /**
     * @return Collection
     */
    public function allOrder():Collection
    {
        return Zamowienie::withTrashed()->get();
    }


    /**
     * @OA\Get(
     *     path="/api/zamowienie/deleted",
     *     tags={"Usunięte zamówienia"},
     *     summary="Lista usuniętych zamówień",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *      ),
     * )
     */


    /**
     * @return Collection
     */
    public function deleted():Collection
    {
        return Zamowienie::onlyTrashed()->get();
    }


    /**
     * @OA\Get(
     *     path="/api/zamowienie/renew/{id}",
     *     tags={"Usunięte zamówienia"},
     *     summary="Przywróć zamówienie",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *      ),
     *
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * )
     */


    /**
     * @param int $id
     *
     * @return String
     */
    public function renew(int $id):String
    {
        $item = Zamowienie::onlyTrashed()
            ->where('id', $id)
            ->first();
        if ($item) {
            Zamowienie::where('id', $id)->restore();
            return "Zamówienie (ID: " . $id . ") został przywrócony";
        } else {
            return "Zamówienie (ID: " . $id . ") nie został wcześniej usunięty lub nie istnieje";
        }
    }
}
