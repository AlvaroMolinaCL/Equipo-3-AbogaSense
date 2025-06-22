<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class LegalCase extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'title',
        'description',
        'status',
    ];

    protected $table = 'legal_cases'; // Asegúrate de que esto esté

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
