<?php

/* auth/views/recover/templates/error.twig */
class __TwigTemplate_8331b2a960847a397962200c7457471c extends Twig_Template
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
        if (isset($context["login_not_exists"])) { $_login_not_exists_ = $context["login_not_exists"]; } else { $_login_not_exists_ = null; }
        if ($_login_not_exists_) {
            // line 2
            echo "<div>При восстановлении пароля произошла ошибка. Запросите восстановление пароля еще раз.</div>
";
        }
    }

    public function getTemplateName()
    {
        return "auth/views/recover/templates/error.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  20 => 2,  17 => 1,);
    }
}
