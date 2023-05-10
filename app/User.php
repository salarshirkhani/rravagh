<?php

namespace App;

use Awobaz\Compoships\Compoships;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Rinvex\Subscriptions\Traits\HasSubscriptions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\MailResetPasswordToken;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasSubscriptions;
    use SoftDeletes;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'type', 'mobile','birthdate','code','account','melli',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'email', 'email_verified_at'
    ];

    protected $appends = [
        'name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function(User $model) {
            if (in_array($model->type, ['customer', 'owner']))
                $model->newDefaultSubscription(app('rinvex.subscriptions.plan')->where('slug', "{$model->type}-default")->first());
        });
    }

    public function getNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function comment() {
        return $this->hasOne('App\comment', 'user_id');
    }

    public function discount() {
        return $this->hasOne('App\discounts', 'user_id');
    }

    public function teacher() {
        return $this->hasMany('App\teacher', 'user_id');
    }

    public function promote() {
        return $this->hasMany('App\promote', 'user_id');
    }

    public function subscribe() {
        return $this->hasMany('App\subscribe', 'user_id');
    }

    public function code() {
        return $this->hasMany('App\code', 'user_id');
    }

    public function academy() {
        return $this->hasMany('App\academy', 'user_id');
    }

    public function order() {
        return $this->hasOne('App\order', 'user_id');
    }

    public function likes() {
        return $this->hasMany('App\likes', 'user_id');
    }

    public function contact() {
        return $this->hasMany('App\contact', 'user_id');
    }

    public function transaction() {
        return $this->hasOne('App\transaction', 'user_id');
    }

    public function company() {
        return $this->hasOne('App\Company', 'creator_id');
    }

    public function conversations() {
        return $this->belongsToMany('App\Conversation')
            ->orderBy('created_at', 'desc');
    }

    public function messages() {
        return $this->hasMany('App\Message', 'from_id');
    }

    public function enquiries() {
        return $this->hasMany('App\Enquiry', 'creator_id');
    }

    public function defaultSubscription() {
        return $this->subscription("{$this->type}-{$this->id}");
    }

    public function newDefaultSubscription($plan) {
        return $this->newSubscription("{$this->type}-{$this->id}", $plan);
    }

    public function routeNotificationForSms() {
        return $this->mobile;
    }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }
    public function scopeBirthDayBetween ($query, Carbon $from, Carbon $till)
    {
        $fromMonthDay = $from->format('m-d');
        $tillMonthDay = $till->format('m-d');
        if ($fromMonthDay <= $tillMonthDay) {
            //normal search within the one year
            $query->whereRaw("DATE_FORMAT(birthdate, '%m-%d') BETWEEN '{$fromMonthDay}' AND '{$tillMonthDay}'");
        } else {
            //we are overlapping a year, search at end and beginning of year
            $query->where(function ($query) use ($fromMonthDay, $tillMonthDay) {
                $query->whereRaw("DATE_FORMAT(birthdate, '%m-%d') BETWEEN '{$fromMonthDay}' AND '12-31'")
                    ->orWhereRaw("DATE_FORMAT(birthdate, '%m-%d') BETWEEN '01-01' AND '{$tillMonthDay}'");
            });
        }
    }
}

