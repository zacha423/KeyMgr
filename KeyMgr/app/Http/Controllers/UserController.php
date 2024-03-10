<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * 
 * Purpose: This controller can be used for managing user management. 
 * Basic login/authentication should be done through Breeze's controllers.
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\UserAPIController as UserAPI;
class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function assignUsersToGroups() //UserGroupAssignment
  {
    $assignments = [];

    
    /**
     * To do:
     * Create form validation on main request
     * pre validate into individual pairs
     * validate each pair, log fail in special array
     * make insertions
    */
  }
}
