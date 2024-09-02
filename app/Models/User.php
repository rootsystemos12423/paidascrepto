<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Mail\CustomResetPasswordMail;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function sendPasswordResetNotification($token)
    {
        $url = url('/reset-password', $token) . '?email=' . urlencode($this->email);
    
        \Mail::to($this->email)->send(new CustomResetPasswordMail($url));
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=f8fafc&background=172554';
    }

    

    public function afiliado()
    {
        return $this->hasOne(Afiliados::class, 'user_id', 'id');
    }


    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function miningMachines()
    {
        return $this->hasMany(MiningMachine::class, 'user_id');
    }

    public function miningRooms()
    {
        return $this->hasMany(MiningRoom::class, 'owner_id');
    }

    public function rooms()
{
    return $this->belongsToMany(Room::class, 'users_rooms');
}


public function dailyBalances()
{
    return $this->hasMany(DailyBalance::class);
}

    protected static function boot()
    {
        parent::boot();

        // Quando um usuário é criado, também cria uma entrada na tabela balances para ele
        static::created(function ($user) {
            $balance = new Balance();
            $balance->user_id = $user->id;
            $balance->balance_btc = 0.00000000;
            $balance->balance_brl = 0.00;
            $balance->balance_alph = 0.00000000;
            $balance->balance_kaspa = 0.00000000;
            $balance->balance_ltc = 0.00000000;
            $balance->save();
        });

        // Quando um usuário é deletado, remove a respectiva entrada na tabela balances
        static::deleted(function ($user) {
            if ($user->balance) {
                $user->balance->delete();
            }
        });
    }

    public function affiliateBalance()
{
    return $this->hasOne(AffiliateBalance::class);
}

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referred_user_id');
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $code = Str::random(6);

            // Verificar se o código já existe (opcional, para garantir unicidade)
            while (Afiliados::where('codigo_afiliado', $code)->exists()) {
                $code = Str::random(6);
            }

            $user->afiliado()->create([
                'codigo_afiliado' => $code,
            ]);

            $user->affiliateBalance()->create([
                'user_id' => $user->id,
                'balance_brl' => 0,
            ]);
        });
    }
}
