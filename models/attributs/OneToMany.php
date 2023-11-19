<?php



#[Attribute(Attribute::TARGET_PROPERTY)]
class OneToMany
{
    public string $name;

    public function __construct(string $classe)
    {

    }
}