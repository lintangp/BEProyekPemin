<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetData extends Model
{
    use HasFactory;

    protected $table = 'budget_datas';

    protected $fillable = ['id_kelompok_anggaran', 'anggaran', 'tanggal', 'jenis', 'keterangan'];
    public $timestamps = true;

    public function budgetGroup()
    {
        return $this->belongsTo(BudgetGroup::class, 'id_kelompok_anggaran');
    }
}

