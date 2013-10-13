<?php

/* content/template.twig */
class __TwigTemplate_1e1ab1ab0bfc1a37a86baaab4c334158 extends Twig_Template
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
        echo "<div>";
        if (isset($context["text"])) { $_text_ = $context["text"]; } else { $_text_ = null; }
        echo $_text_;
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "content/template.twig";
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
