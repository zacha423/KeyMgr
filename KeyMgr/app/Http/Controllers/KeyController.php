<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreKeyRequest;
use App\Http\Requests\UpdateKeyRequest;
use App\Models\Key;
use App\Models\KeyStatus;
use App\Models\KeyStorage;
use App\Models\KeyType;
use App\Models\Keyway;
use App\Models\Building;
use App\Models\Room;
use App\Models\Door;
use App\Http\Resources\KeyResource;
use Illuminate\Http\Request;

class KeyController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $data = [];

    foreach (Key::all() as $key) {
      $btnEdit = '<a href="' . route('key.edit', $key->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-pen"></i>
        </button>';
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-key-id="' . $key->id . '">
        <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';
      $btnDetails = '<a href="' . route('key.show', $key->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
              <i class="fa fa-lg fa-fw fa-eye"></i>
          </button>';


          array_push($data, [
            'id' => (int)$key->id,
            'keyLevel' => (string)$key->keyLevel,
            'keySystem' => (string)$key->keySystem,
            'copyNumber' => (int)$key->copyNumber,
            'bitting' => (string)$key->bitting,
            'blindCode' => (string)$key->blindCode,
            'mainAngles' => (string)$key->mainAngles,
            'doubleAngles' => (string)$key->doubleAngles,
            'replacementCost' => (float)$key->replacementCost,
            'actions' => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
        ]);
            }

    return view('key.keys', [
      'keys' => $data,
      'keysJSON' => Key::all()->toJson(),
    ]);
  }


  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreKeyRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Key $key)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Key $key)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateKeyRequest $request, Key $key)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Key $key)
  {
    //
  }
}
