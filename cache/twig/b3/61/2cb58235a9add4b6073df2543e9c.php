<?php

/* editors/language/template.twig */
class __TwigTemplate_b3612cb58235a9add4b6073df2543e9c extends Twig_Template
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
        echo "<select name=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" id=\"";
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        echo $this->getAttribute($_param_, "name");
        echo "\" class=\"form-control\">
    ";
        // line 2
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_param_, "options"));
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 3
            echo "        <option value=\"";
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo $this->getAttribute($_option_, "name");
            echo "\" ";
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            if ($this->getAttribute($_option_, "selected")) {
                echo "selected=\"selected\"";
            }
            echo ">";
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo $this->getAttribute($_option_, "title");
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 5
        echo "</select>";
    }

    public function getTemplateName()
    {
        return "editors/language/template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 5,  31 => 3,  26 => 2,  17 => 1,);
    }
}
