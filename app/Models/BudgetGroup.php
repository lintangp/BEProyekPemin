<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetGroup extends Model
{
    use HasFactory;


    protected $table = 'budget_groups';

    protected $fillable = ['nama_kelompok', 'deskripsi'];
    public $timestamps = true;
}
