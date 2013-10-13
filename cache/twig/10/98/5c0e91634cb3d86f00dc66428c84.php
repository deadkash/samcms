<?php

/* editors/textarea/template.twig */
class __TwigTemplate_10985c0e91634cb3d86f00dc66428c84 extends Twig_Template
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
        echo "<textarea class=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "class");
        echo " form-control\" id=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" name=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" rows=\"3\">";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "default");
        echo "</textarea>";
    }

    public function getTemplateName()
    {
        return "editors/textarea/template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  17 => 1,);
    }
}
