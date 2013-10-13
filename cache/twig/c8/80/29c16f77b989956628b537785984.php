<?php

/* auth/views/recover/templates/step4.twig */
class __TwigTemplate_c88029c16f77b989956628b537785984 extends Twig_Template
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
        echo "<div>Пароль изменен. Теперь вы можете <a href=\"";
        if (isset($context["auth"])) { $_auth_ = $context["auth"]; } else { $_auth_ = null; }
        echo $_auth_;
        echo "\">авторизоваться</a>.</div>";
    }

    public function getTemplateName()
    {
        return "auth/views/recover/templates/step4.twig";
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
