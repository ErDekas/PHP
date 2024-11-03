<?php
interface JSerializable
{
    public function toJSON(): string;
    public function toSerialize(): string;
}
