<?php

namespace App\Http\Resources;

use App\Models\Organizer;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "name" => $this->name,
            "email" => $this->email,
            "organizer" => Organizer::where('id', $this->organizer_id)->first()->name,
            "qr_code" => $this->qr_code
        ];
    }
}
