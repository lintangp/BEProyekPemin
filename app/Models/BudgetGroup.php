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

    public function budgetData()
    {
        return $this->hasMany(BudgetData::class, 'id_kelompok_anggaran');
    }
}
