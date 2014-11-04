<?php
namespace Tectonic\Localisation\Translator;

trait Translatable
{
    /**
     * Returns an array of the field names that can be used for translations.
     *
     * @return array
     */
    abstract public function translatableFields();

    /**
     * Returns the base name of the class, to be used as the resource when creating translations.
     *
     * @return string
     */
    public function translatableResource()
    {
        $object = get_class($this);
        $namespace = explode('\\', $object);

        return array_pop($namespace);
    }
}
