<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'body', 'user_id', 'commenter_name', 'approved', 'reviewed_by'];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function reviewer() {
        return $this->belongsTo('App\User', 'reviewed_by');
    }

    public function getStatusAttribute() {
        switch($this->approved){
            case 0:
                return "pending";
            case 1:
                return "declined";
            case 2:
                return "approved";
            default:
                return "pending";
        }
    }

    public function scopeApproved($query) {
        return $query->where('approved', 2);
    }

    public function scopePending($query) {
        return $query->where('approved', 0);
    }

    public function scopeByPost($query, $post) {
        return $query->where('post_id', $post);
    }

    public function transform()
    {
        return [
            'id'   => $this->id,
            'body' => $this->body,
            'date' => $this->created_at->format('Y-m-d H:i:s'),
            'commenter_name' => $this->commenter_name
        ];
    }
}
