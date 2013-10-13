<?php

/* config.twig */
class __TwigTemplate_0d15243eae9e88baf6ed74939c003f5e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<?php

/**
 * Файл конфигурации системы
 * Файл сгенерирован автоматически.
 *
 * @project SamCMS
 * @author Kash
 * @package root
 * @date 28.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
*/

class Config {

";
        // line 16
        if (isset($context["params"])) { $_params_ = $context["params"]; } else { $_params_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_params_);
        foreach ($context['_seq'] as $context["_key"] => $context["param"]) {
            // line 17
            echo "    public static \$";
            if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
            echo $this->getAttribute($_param_, "name");
            echo " = '";
            if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
            echo $this->getAttribute($_param_, "value");
            echo "';

";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['param'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 20
        echo "}";
    }

    public function getTemplateName()
    {
        return "config.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 20,  39 => 17,  34 => 16,  17 => 1,);
    }
}
