<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User extends Authenticatable implements JWTSubject
{

    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
   /**
     *
     * @OA\Schema(
     * required={"password"},
     * @OA\Xml(name="User"),
     * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     * @OA\Property(property="role", type="string", readOnly="true", description="User role"),
     * @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
     * @OA\Property(property="email_verified_at", type="string", readOnly="true", format="date-time", description="Datetime marker of verification status", example="2022-02-25 12:59:20"),
     * @OA\Property(property="name", type="string", maxLength=32, example="John"),
     * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
     * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at"),
     * )
     * Class User
     *
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles');
    }
    public function hasRole($role)
    {
      if ($this->roles()->where('name', $role)->first()) {
        return true;
      }
      return false;
    }
    public function isAdmin()
    {
        return $this->roles()->where('name','admin')->exists();
    }

    public function isCompany()
    {
        return $this->roles()->where('id','2')->exists();
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'manager_id')->ofMany();
    }
    public function checkCompany($company_id)
    {
        if($company_id == $this->company->id){
            return true;
        }else{
            return false;
        }
    }
    public function checkEmployee($employee_id)
    {
        $employees = $this->company->employees->pluck('id')->toArray();
        if(in_array($employee_id,$employees)){
            return true;
        }else{
            return false;
        }
    }

}
