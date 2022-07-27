<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    public const MALE = 'Male';
    public const FEMALE = 'Female';

    private string $name,
    private string $gender,
    private float $age
    private int $parent_id;

    public function __construct(
        private string $name,
        private string $gender,
        private float $age,
        private int $parent_id
    ){
        $this->name = $name;
        $this->gender = $gender;
        $this->age = $age;
        $this->parent_id = $parent_id;
    }


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

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = ucwords(trim($gender));
        return $this;
    }

    public function getAge(): float
    {
        return floatval($this->age);
    }

    public function setGender(float $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function getParent(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = ucwords(trim($gender));
        return $this;
    }

    // Relations
    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
