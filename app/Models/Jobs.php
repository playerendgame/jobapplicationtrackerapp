<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobs extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'jobdetails';//Had to declare this to ensure laravel discovers this table name


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'companyName',
        'jobPosition',
        'platform',
        'status',
        'notes',
    ];

    //Connecting User Model here to Jobs Model
    public function userAccount(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

}
