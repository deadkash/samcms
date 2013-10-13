<?php

/* editors/checkbox/template.twig */
class __TwigTemplate_c18669e8602b24ef5b04fa765454ac8a extends Twig_Template
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
        echo "<input type=\"checkbox\" id=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" name=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" value=\"1\" ";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        if ($this->getAttribute($_param_, "default")) {
            echo "checked=\"checked\"";
        }
        echo ">";
    }

    public function getTemplateName()
    {
        return "editors/checkbox/template.twig";
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
