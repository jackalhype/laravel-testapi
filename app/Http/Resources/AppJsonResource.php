<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AppJsonResource extends JsonResource
{
    public function ftime (Carbon $time) {
        return $time->format('Y-m-d H:i:s P');
    }
}
