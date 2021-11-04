<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Departement extends JsonResource
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
            'id'         => $this->id,
            'departement'       => $this->departement,
            'sigle'    => $this->sigle,
            'chef_id'     => (int) $this->chef_id,
            'parent'     => (int) $this->parent,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
