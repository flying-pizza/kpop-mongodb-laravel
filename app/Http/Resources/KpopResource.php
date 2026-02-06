<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KpopResource extends JsonResource
{

    public $status;
    public $message;

    public function __construct($resource, $status = true, $message = '')
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Access fields using the actual keys found in the database (which appear duplicated)

        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => [
            'id' => (string) $this->_id,
            'stage_name' => $this->stage_name,
            'full_name' => $this->full_name,
            'k_name' => $this->k_name,
            'k_group' => $this->k_group,
            'country' => $this->country,
            'birthplace' => $this->birthplace,
            'gender' => $this->gender,
            'height' => $this->height,
            'weight' => $this->weight,
            'birth' => $this->birth,
            'instagram' => $this->instagram, 
            ]
            
        ];
    }
}
