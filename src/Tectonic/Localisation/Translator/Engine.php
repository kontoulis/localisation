<?php
namespace Tectonic\Localisation\Translator;

use Tectonic\Localisation\Contracts\Transformer;

/**
 * Class Engine
 *
 * Works on a single object, and calls the appropriate transformer to work on said object. You can
 * register any number of transformers that can be used to transform a given object for translation.
 *
 * Simply call the registerTransformer method:
 *
 *     $engine->registerTransformer($transformer);
 *
 * @package Tectonic\Shift\Modules\Localisation\Support\Transformers
 */
class Engine
{
    /**
     * Stores the possible translators that can be used for object translation.
     *
     * @var array
     */
    private $transformers = [];

    /**
     * The translate method is simply a helper that can be used as the entry point for all translations.
     *
     * @deprecated
     * @param mixed $object
     * @param null $language
     * @return mixed
     */
    public function translate($object, $language = null)
    {
        return $this->transform($object, $language, 'transform');
    }

    /**
     * Same as translate, but only translate the first level of objects.
     *
     * @param mixed $object
     * @param string|null $language
     * @return mixed
     */
    public function shallow($object, $language = null)
    {
        return $this->transform($object, $language, 'shallow');
    }

    /**
     * Finds the correct transformer and then calls the appropriate method, if found.
     *
     * @param object $object
     * @param string|null $language
     * @param string $method
     * @return mixed
     */
    private function transform($object, $language, $method)
    {
        foreach ($this->transformers as $transformer) {
            if ($transformer->isAppropriateFor($object)) {
                return $transformer->$method($object, $language);
            }
        }

        return $object;
    }

    /**
     * Registers a new transformer that can be used for translations. You can pass
     * many transformers at once, if you so wish.
     *
     * @param Transformer $transformers
     */
    public function registerTransformer(Transformer ...$transformers)
    {
        foreach ($transformers as $transformer) {
            $this->transformers[] = $transformer;
        }
    }
}
