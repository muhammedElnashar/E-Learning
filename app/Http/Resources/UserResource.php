<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
     return [
         'id' => $this->id,
         'name' => $this->name,
         'email' => $this->email,
         'password' => $this->password,
         'national_id' => $this->national_id,
         'gender' => $this->gender,
         'phone' => $this->phone,
         'address' => $this->address,
         'image' => asset('images/users/'.$this->image),
         'role_id' => $this->role_id,
         'title'=>$this->title,
         'description'=>$this->description,
         ];
    }
}
