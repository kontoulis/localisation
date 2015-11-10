<?php
namespace Tests\Stubs;

use Tectonic\Localisation\Contracts\Transformer;

class InvalidTransformerStub implements Transformer
{
    public function isAppropriateFor($object)
    {
        return false;
    }

    public function transform($object)
    {
        // won't do anything
    }

    public function shallow($object)
    {
        // TODO: Implement shallow() method.
    }
}
 