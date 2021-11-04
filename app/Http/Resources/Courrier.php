<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Courrier extends JsonResource
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
            'client'       => $this->client,
            'date'    => $this->date,
            'status'     => $this->status,
            'fileUrl'     => $this->fileUrl,
            'departement_affecte'     => (int) $this->departement_affecte,
            'agent_affecte'     => (int) $this->agent_affecte,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
