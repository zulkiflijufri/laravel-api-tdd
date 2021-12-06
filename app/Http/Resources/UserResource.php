<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'users',
            'attributes' => [
                'id' => $this->id,
                'name' => $this->name,
                'age' => $this->age,
                'email' => $this->email,
                'username' => $this->username,

            ],
            'links' => [
                'parent' => route('users.index'),
                'self' => route('users.show', $this->id)
            ],
        ];
    }
}
