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
        $user = $request->user(); // Lấy thông tin người dùng từ request
        $isOwner = $user && $user->id === $this->id;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "email_verified_at" => $this->email_verified_at,
            // "fcm_tokens" => $isOwner ? $this->fcm_tokens : [],
        ];
    }
}
