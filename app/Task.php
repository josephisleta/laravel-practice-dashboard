<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_DONE = 1;

    const TYPE_ACTIVE = 'Active';
    const TYPE_COMPLETED = 'Completed';
    const TYPE_OVERDUE = 'Overdue';

    const FLASH_CREATED_TASK = 'Successfully created new task';
    const FLASH_DELETED_TASK = 'Successfully deleted task';
    const FLASH_EDITED_TASK = 'Successfully edited task';

    protected $fillable = ['title', 'body', 'status', 'due_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
