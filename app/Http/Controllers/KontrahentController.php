<?php

namespace App\Http\Controllers;

use App\Http\Requests\KontrahentRequest;
use App\Models\Kontrahent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class KontrahentController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Kontrahent",
     *     description="Zarządzanie kontrahentami",
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/kontrahent",
     *     tags={"Kontrahent"},
     *     summary="Wyświetl listę kontrahentów",
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
    public function index():Collection
    {
        return Kontrahent::with('typeOfContractor')->get();
    }

    /**
     * @OA\Get(
     *     path="/api/kontrahent/{id}",
     *     tags={"Kontrahent"},
     *     summary="Wyświetl kontrahenta",
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
     * @return Kontrahent
     */
    public function show(int $id):Kontrahent
    {
            return Kontrahent::findOrFail($id)
                ->with('typeOfContractor')
                ->where('id', $id)
                ->first();
    }

    /**
     * @OA\Post (
     *     path="/api/kontrahent",
     *     tags={"Kontrahent"},
     *     summary="Dodaj kontrahenta",
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
     *                         property="type",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                      @OA\Property(
     *                         property="companyName",
     *                         type="string",
     *                         example="Przykładowy nazwa firmy"
     *                      ),
     *                      @OA\Property(
     *                         property="lname",
     *                         type="string",
     *                         example="Jan"
     *                      ),
     *                      @OA\Property(
     *                         property="fname",
     *                         type="string",
     *                         example="Kowalski"
     *                      ),
     *                      @OA\Property(
     *                         property="location",
     *                         type="string",
     *                         example="Rzeszów"
     *                      ),
     *                      @OA\Property(
     *                         property="postalCode",
     *                         type="string",
     *                         example="35-005"
     *                      ),
     *                      @OA\Property(
     *                         property="street",
     *                         type="string",
     *                         example="aleja Tadeusza Rejtana"
     *                      ),
     *                      @OA\Property(
     *                         property="numberHouse",
     *                         type="string",
     *                         example="55"
     *                      ),
     *                      @OA\Property(
     *                         property="numberApartment",
     *                         type="string",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="numberPhone",
     *                         type="integer",
     *                         example="17 282 50 00"
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="email",
     *                         example="example@zetorzeszow.pl"
     *                      ),
     *                      @OA\Property(
     *                         property="comments",
     *                         type="string",
     *                         example="Uwagi"
     *                      ),
     *        )
     *     ),
     * )
     */


    /**
     * @param KontrahentRequest $request
     *
     * @return Kontrahent
     */
    public function store(KontrahentRequest $request):Kontrahent
    {
        $newItem = new Kontrahent;
        $newItem->type_id = $request->get("type_id");
        $newItem->companyName = $request->get("companyName");
        $newItem->lname = $request->get("lname");
        $newItem->fname = $request->get("fname");
        $newItem->location = $request->get("location");
        $newItem->postalCode = $request->get("postalCode");
        $newItem->street = $request->get("street");
        $newItem->numberHouse = $request->get("numberHouse");
        $newItem->numberApartment = $request->get("numberApartment");
        $newItem->numberPhone = $request->get("numberPhone");
        $newItem->email = $request->get("email");
        $newItem->comments = $request->get("comments");
        $newItem->save();

        return $newItem;
    }

    /**
     * @OA\Put(
     *     path="/api/kontrahent/{id}",
     *     tags={"Kontrahent"},
     *     summary="Edytuj kontrahenta",
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
     *                         property="type",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                      @OA\Property(
     *                         property="companyName",
     *                         type="string",
     *                         example="Przykładowy nazwa firmy"
     *                      ),
     *                      @OA\Property(
     *                         property="lname",
     *                         type="string",
     *                         example="Jan"
     *                      ),
     *                      @OA\Property(
     *                         property="fname",
     *                         type="string",
     *                         example="Kowalski"
     *                      ),
     *                      @OA\Property(
     *                         property="location",
     *                         type="string",
     *                         example="Rzeszów"
     *                      ),
     *                      @OA\Property(
     *                         property="postalCode",
     *                         type="string",
     *                         example="35-005"
     *                      ),
     *                      @OA\Property(
     *                         property="street",
     *                         type="string",
     *                         example="aleja Tadeusza Rejtana"
     *                      ),
     *                      @OA\Property(
     *                         property="numberHouse",
     *                         type="string",
     *                         example="55"
     *                      ),
     *                      @OA\Property(
     *                         property="numberApartment",
     *                         type="string",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="numberPhone",
     *                         type="integer",
     *                         example="17 282 50 00"
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="email",
     *                         example="example@zetorzeszow.pl"
     *                      ),
     *                      @OA\Property(
     *                         property="comments",
     *                         type="string",
     *                         example="Uwagi"
     *                      ),
     *        ),
     *     ),
     * )
     */


    /**
     * @param KontrahentRequest $request
     * @param int $id
     *
     * @return Kontrahent
     */
    public function update(KontrahentRequest $request,int $id):Kontrahent
    {
        $newItem = Kontrahent::find($id);
        $newItem->update($request->all());
        return $newItem;
    }

    /**
     * @OA\Delete(
     *     path="/api/kontrahent/{id}",
     *     tags={"Kontrahent"},
     *     summary="Usuń kontrahenta",
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
     * @return Kontrahent
     */
    public function destroy(int $id):String
    {
        if (Kontrahent::find($id)) {
            Kontrahent::destroy($id);
            return "Pomyślnie usunięto produkt (ID: " . $id . ")";
        } else {
            return "Kontrahent (ID: " . $id . ") nie istnieje";
        }
    }

    /**
     * @OA\Tag(
     *     name="Usunięci kontrahenci",
     *     description="Zarządzanie usuniętymi kontrahentami",
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/kontrahent/allContractor",
     *     tags={"Usunięci kontrahenci"},
     *     summary="Lista wszystkich utworzonych kontrahentów",
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
    public function allContractor():Collection
    {
        return Kontrahent::withTrashed()->get();
    }

    /**
     * @OA\Get(
     *     path="/api/kontrahent/deleted",
     *     tags={"Usunięci kontrahenci"},
     *     summary="Lista usuniętych kontrahentów",
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
        return Kontrahent::onlyTrashed()->get();
    }

    /**
     * @OA\Get(
     *     path="/api/kontrahent/renew/{id}",
     *     tags={"Usunięci kontrahenci"},
     *     summary="Przywróć kontrahenta",
     *     security={{"bearerAuth":{}}},
     *
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
        $item = Kontrahent::onlyTrashed()
            ->where('id', $id)
            ->first();
        if ($item) {
            Kontrahent::where('id', $id)->restore();
            return "Kontrahent (ID: " . $id . ") został przywrócony";
        } else {
            return "Kontrahent (ID: " . $id . ") nie został wcześniej usunięty lub nie istnieje";
        }
    }
}
