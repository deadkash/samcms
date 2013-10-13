<?php

/* message/template.twig */
class __TwigTemplate_690233169e47b3bebf3df3d280393454 extends Twig_Template
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
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($_messages_) {
            // line 2
            if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_messages_);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 3
                echo "<div class=\"alert fade in ";
                if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                echo $this->getAttribute($_message_, "type");
                echo "\">
    <button class=\"close\" data-dismiss=\"alert\">×</button>
    ";
                // line 5
                if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                echo $this->getAttribute($_message_, "text");
                echo "
</div>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
        }
    }

    public function getTemplateName()
    {
        return "message/template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 5,  25 => 3,  20 => 2,  17 => 1,);
    }
}
