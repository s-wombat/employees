<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'surname', 'email', 'position', 'employment_date', 'salary',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function boss()
    {
        return $this->belongsTo('App\Boss');
    }
    public function image()
    {
        return $this->hasOne('App\Image');
    }
    public function getSmallAttribute()
    {
        $image_path = Image::where('title', '=', 'small')
            ->where('user_id', '=', $this->id)
            ->select('images.image_path')
            ->get();
        return url('upload/products/' . $this->id . '/' . $image_path->image_path);
    }
    public function getMiddleAttribute()
    {
        $image_path = Image::where('title', '=', 'middle')
            ->where('user_id', '=', $this->id)
            ->select('images.image_path')
            ->get();
        return url('upload/products/' . $this->id . '/' . $image_path->image_path);
    }
}
