<?php

/* auth/views/recover/templates/step1.twig */
class __TwigTemplate_825d9a8eac6813c5cfc7a3c8b6d22507 extends Twig_Template
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
        echo "<div class=\"container\">
    ";
        // line 2
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($_errors_) {
            // line 3
            echo "        <div class=\"alert fade in alert-danger\">
            <button class=\"close\" data-dismiss=\"alert\">×</button>
            ";
            // line 5
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_errors_);
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 6
                echo "                ";
                if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                if (($_error_ == "invalid_email")) {
                    echo "Пожалуйста, введите корректный e-mail<br>";
                }
                // line 7
                echo "                ";
                if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                if (($_error_ == "mail_not_send")) {
                    echo "При отправке письма произошла ошибка!<br>";
                }
                // line 8
                echo "                ";
                if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                if (($_error_ == "mail_not_exists")) {
                    echo "Указанный вами e-mail не существует.<br>";
                }
                // line 9
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 10
            echo "        </div>
    ";
        }
        // line 12
        echo "    <form class=\"form-signin\" method=\"POST\" action=\"\">
        <h3 class=\"form-signin-heading\">Введите e-mail, указанный Вами при регистрации</h3>
        <input name=\"email\" type=\"text\" class=\"form-control\" placeholder=\"E-mail\">
        <button type=\"submit\" name=\"step\" value=\"2\" class=\"btn btn-lg btn-primary btn-block\">Отправить</button>
        <div class=\"login-links\">
            <a href=\"";
        // line 17
        if (isset($context["auth"])) { $_auth_ = $context["auth"]; } else { $_auth_ = null; }
        echo $_auth_;
        echo "\">Я вспомнил пароль!</a>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "auth/views/recover/templates/step1.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 17,  60 => 12,  56 => 10,  50 => 9,  44 => 8,  38 => 7,  32 => 6,  27 => 5,  23 => 3,  20 => 2,  17 => 1,);
    }
}
