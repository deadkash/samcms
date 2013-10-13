<?php

/* editors/image/image.twig */
class __TwigTemplate_7b14e9e664522fbda03b235f6d124f09 extends Twig_Template
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
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        if ($this->getAttribute($_param_, "default")) {
            // line 2
            echo "<img src=\"";
            if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
            echo $this->getAttribute($_param_, "default");
            echo "\" alt=\"\" style=\"max-width: 400px; max-height: 400px;display: block;border: 1px solid #ddd; padding: 5px;margin-bottom: 20px;\"/>
";
        }
        // line 4
        echo "<input type=\"file\" class=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "class");
        echo "\" id=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" name=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" value=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "default");
        echo "\">";
    }

    public function getTemplateName()
    {
        return "editors/image/image.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 4,  20 => 2,  17 => 1,);
    }
}
