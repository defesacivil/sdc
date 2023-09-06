<?php

namespace App\Models\Compdec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComRegiao extends Model
{
    use HasFactory;

    protected $table = 'com_regiaos';
    protected $primaryKey = 'id';
    


  /**
   * Get the user that owns the ComRegiao
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function compdec()
  {
      return $this->belongsTo(Compdec::class, 'regiao_id', 'id');
  }

}
