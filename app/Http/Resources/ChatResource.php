<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->user->username,
            'user_id' => $this->user->id,
            'chat_room_id' => $this->chat_room_id,
            'message' => $this->message,
            'total_likes' => $this->total_likes,
            'total_deslikes' => $this->total_deslikes,
            'is_sender' => $this->user->id == auth()->user()->id ? true : false,
        ];
    }
}
