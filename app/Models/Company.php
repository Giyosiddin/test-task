<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     title="Company",
 *     description="Company model, companies can be changed or added only by admins.",
 *     @OA\Xml(
 *         name="Company"
 *     )
 * )
 */
class Company extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'company_name',
        'supervisor',
        'address',
        'email',
        'website',
        'phone',
        'manager_id'
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
