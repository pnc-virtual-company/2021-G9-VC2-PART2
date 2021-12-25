<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlumniResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id"=>$this->id,
            "user_id"=>$this->user_id,
            "phone_number"=>$this->phone_number,
            "gender"=>$this->gender,
            "batch"=>$this->batch,
            "major"=>$this->major,
            "profile"=>$this->profile,
            "created_at"=>$this->created_at->format('j, l F, Y | h:i:s A'),
            "updated_at"=>$this->updated_at->format('j, l F, Y | h:i:s A')
        ];
    }
}
