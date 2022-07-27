<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Api\Child;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];

    // Getters & setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = trim($name);
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = trim($email);
        return $this;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = trim($phone_number);
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = Hash::make($password);
        return $this;
    }

    public function getPartner(): ?User
    {
        return $this->partner;
    }

    public function setPartner(?int $partner_id): self
    {
        $this->partner_id = $partner_id;
        return $this;
    }

    // Relations
    public function partner(): HasOne
    {
        return $this->hasOne(User::class, 'partner_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Child::class);
    }
}
