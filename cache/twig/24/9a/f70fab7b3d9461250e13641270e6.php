<?php

/* auth/views/recover/templates/letter.twig */
class __TwigTemplate_249af70fab7b3d9461250e13641270e6 extends Twig_Template
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
        echo "<html>
<head></head>
<body>
<div>
    <p>Вы запросили восстановление пароля на ";
        // line 5
        if (isset($context["host"])) { $_host_ = $context["host"]; } else { $_host_ = null; }
        echo $_host_;
        echo "</p>
    <p>Вы можете установить новый пароль, перейдя по <a href=\"";
        // line 6
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\">ссылке</a>.</p>
</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "auth/views/recover/templates/letter.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 6,  23 => 5,  17 => 1,);
    }
}
