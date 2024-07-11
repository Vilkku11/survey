<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
    
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => (new Carbon($this->created_at))->format
            ('d.m.Y'),
            'modified_at' => (new Carbon($this->updated_at))->format
            ('d.m.Y'),
            //'user_id' => $this->userId,
        ];
    }
}
