<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $fillable = [
        'name',
        'email',
        'password',
        'code',
        'expire_at'
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
  /*  public static function boot()
    {
        parent::boot();
    
        static::saving(function ($model) {
            $model->timestamps = false;
            if (!$model->code) {
                $model->code = random_int(100000, 999999);
            }
    
            if (!$model->expire_at) {
                $model->expire_at = now()->addMinutes(10);
            }
        });
    }*/
    public function generateCode()
    {
        // Tạo mã OTP ngẫu nhiên
        $code = rand(100000, 999999);
    
        // Thiết lập thời gian hết hạn cho mã OTP (10 phút kể từ thời điểm hiện tại)
        $expire_at = now()->addMinutes(10);
    
        // Đảm bảo là bạn đang cập nhật các trường đúng cách
        $this->update([
            'code' => $code,
            'expire_at' => $expire_at,
        ]);
    
        // Kiểm tra kết quả sau khi cập nhật
        \Log::info("Code: {$this->code}, Expire At: {$this->expire_at}");
        
    }
    public static function boot()
{
    parent::boot();

    static::saving(function ($model) {
        // Kiểm tra nếu bạn không muốn giá trị bị ghi đè ở đây
        if (!$model->code) {
            $model->code = rand(100000, 999999);
        }
        if (!$model->expire_at) {
            $model->expire_at = now()->addMinutes(10);
        }
    });
}



    


    public function resetCode()
{
    // Tạo mã OTP mới
    $newOtpCode = null;

    // Lưu mã OTP mới vào cơ sở dữ liệu
    $this->update([
        'code' => $newOtpCode, // Cột "code" phải tồn tại trong bảng users
    ]);

    return $newOtpCode;
}


}
