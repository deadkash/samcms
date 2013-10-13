<?php

/* editors/section/template.twig */
class __TwigTemplate_ab7d0455e70f257ad443cba2e3fca6ed extends Twig_Template
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
    <option value=\"\">-- ";
        // line 2
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "core_not_selected");
        echo "</option>
    ";
        // line 3
        if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_param_, "options"));
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 4
            echo "        <option value=\"";
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo $this->getAttribute($_option_, "id");
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
        // line 6
        echo "</select>";
    }

    public function getTemplateName()
    {
        return "editors/section/template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 6,  36 => 4,  31 => 3,  26 => 2,  17 => 1,);
    }
}
