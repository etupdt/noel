<?php



#[Attribute(Attribute::TARGET_PROPERTY)]
class ManyToOne
{
    public string $name;

    public function __construct(string $classe)
    {

    }
}