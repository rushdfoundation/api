<?php

namespace App\Models;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; // this sould be imported
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject 
{
    use HasApiTokens, HasFactory, Notifiable;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'name',
      'avatar',
      'email',
      'phone',
      'unique_id',
      'password',
      'is_active',
      'is_logedin',
      'school_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [
        'email'=>$this->email,
        'name'=>$this->name
      ];
    }
    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }
    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;
    }
    
    public function student(){
      return $this->hasOne(Student::class);
    }
    public function teacher(){
      return $this->hasOne(Teacher::class);
    }
    public function guarian(){
      return $this->hasOne(Guardian::class);
    }
    public function trainee(){
      return $this->hasOne(Trainee::class);
    }
    public function educations(){
      return $this->hasMany(Education::class);
    }
    public function experiences(){
      return $this->hasMany(Experience::class);
    }
    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }
    public function assessments(){
      return $this->belongsToMany(Assessment::class,'user_assessment')->withPivot('mark','teacher_comment');
    }
    public function homeworks()
    {
        return $this->belongsToMany(Homework::class,'user_homework')->withPivot('mark','teacher_comment');
    }
    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withPivot('status');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function activities(){
      return $this->hasMany(Activity::class);
    }
    public function attendances(){
      return $this->hasMany(Attendance::class);
    }


}
