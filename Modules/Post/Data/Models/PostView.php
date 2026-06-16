<?php

namespace Post\Data\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'user_id',
    'post_id',
    'view_date',
    'viewed_at',
    'ip_address',
    'user_agent',
])]
class PostView extends Model
{
    //
}
