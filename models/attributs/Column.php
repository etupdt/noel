<?php



#[Attribute(Attribute::TARGET_PROPERTY)]
class Column
{
    public string $name;

    public function __construct(string $classe)
    {

    }
}