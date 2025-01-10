<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TaskResource extends JsonResource
{
    //This public static $wrap is the reason we can see it in our frontend when the user want to edit.
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //This return is the reason we can see it in our frontend when the user want to edit.
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'description' => $this->description,
            'created_at' => (new Carbon($this->created_at))->format("Y-m-d"),
            'due_date' => (new Carbon($this->due_date))->format('Y-m-d'),
            'status' => $this->status,
            'priority' => $this->priority,
            'image_path' => $this->image_path ? Storage::url($this->image_path) :'', //This image_path will render the image the user uploaded.
            'project_id'=> $this->project_id,
            'project'=> new ProjectResource($this->project),
            'assignedUser'=> $this->assignedUser  ? new UserResource($this->assignedUser) : null,
            'assigned_user_id' => $this->assigned_user_id,
            'task_image_path' => $this->task_image_path,
            'createdBy'=> new UserResource($this->createdBy),
            'updatedBy' => new UserResource($this->updatedBy), 
        ];
    }
}
