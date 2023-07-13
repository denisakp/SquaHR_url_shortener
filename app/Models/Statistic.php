<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = ['short_link_id', 'visitor'];

    /**
     * Inverse relation
     * @return BelongsTo
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(ShortLink::class);
    }

    /**
     * @return mixed
     */
    public static function  getMostClickedUrl(): mixed
    {
        $element = DB::table('statistics')
            ->select('short_link_id', DB::raw('COUNT(*) as row_count'))
            ->groupBy('short_link_id')
            ->orderByDesc('row_count')
            ->first();

        return $element->short_link_id;
    }
}
