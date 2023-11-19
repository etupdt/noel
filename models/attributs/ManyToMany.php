<?php



#[Attribute(Attribute::TARGET_PROPERTY)]
class ManyToMany
{
    public string $name;

    public function __construct(string $classe)
    {

    }
}