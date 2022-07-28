<?php

namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Child extends Model
{
    use HasFactory;

    public const MALE = 'Male';
    public const FEMALE = 'Female';

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
        if (is_string($name))
            $this->name = trim($name);

        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        if (is_string($gender))
            $this->gender = ucwords(trim($gender));

        return $this;
    }

    public function getAge(): float
    {
        return floatval($this->age);
    }

    public function setAge(float $age): self
    {
        if (is_numeric($age))
            $this->age = $age;
            
        return $this;
    }

    public function getParent(): ?User
    {
        return $this->parent;
    }

    public function setParent(int $parent_id): self
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    // Relations
    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
