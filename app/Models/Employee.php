<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     title="Employee",
 *     description="Employee model, employees can be changed or added by admins and users that have company role.",
 *     @OA\Xml(
 *         name="Employee"
 *     )
 * )
 */
class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'passport_serial',
        'first_name',
        'last_name',
        'father_name',
        'position',
        'phone',
        'address',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
