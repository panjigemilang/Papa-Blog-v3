<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        if (sizeof($data) > 0) {
            return [
                'status' => 'success',
                'message' => 'posts data',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'post not found'
            ];
        }
    }
}
