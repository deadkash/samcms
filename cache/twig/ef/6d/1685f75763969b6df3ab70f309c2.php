<?php

/* admin_content.twig */
class __TwigTemplate_ef6d1685f75763969b6df3ab70f309c2 extends Twig_Template
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
        echo "<div class=\"jumbotron\">
    <div class=\"container\">
        <h1>";
        // line 3
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_welcome");
        echo "</h1>
        <p>";
        // line 4
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_admin_panel");
        echo "</p>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "admin_content.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 4,  21 => 3,  17 => 1,);
    }
}
