<?php

/* user/template.twig */
class __TwigTemplate_e4a25784e65e005d70be44b11f77d03b extends Twig_Template
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
        echo "<ul class=\"nav navbar-nav pull-right\">
    <li class=\"dropdown\">
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
            <i class=\"glyphicon glyphicon-user\"></i>&nbsp;";
        // line 4
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo $this->getAttribute($_user_, "login");
        echo " <b class=\"caret\"></b>
        </a>
        <ul class=\"dropdown-menu\">
            <li><a href=\"";
        // line 7
        if (isset($context["logout"])) { $_logout_ = $context["logout"]; } else { $_logout_ = null; }
        echo $_logout_;
        echo "\"><i class=\"glyphicon glyphicon-off\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "core_exit");
        echo "</a></li>
        </ul>
    </li>
</ul>";
    }

    public function getTemplateName()
    {
        return "user/template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 7,  22 => 4,  17 => 1,);
    }
}
