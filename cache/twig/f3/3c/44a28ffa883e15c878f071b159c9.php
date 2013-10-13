<?php

/* auth/views/recover/templates/step3.twig */
class __TwigTemplate_f33c44a28ffa883e15c878f071b159c9 extends Twig_Template
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
        // line 2
        echo "    ";
        // line 3
        echo "    ";
        // line 4
        echo "        ";
        // line 5
        echo "        ";
        // line 6
        echo "        ";
        // line 7
        echo "        ";
        // line 8
        echo "        ";
        // line 9
        echo "    ";
        // line 10
        echo "    ";
        // line 11
        echo "    ";
        // line 12
        echo "    ";
        // line 13
        echo "        ";
        // line 14
        echo "        ";
        // line 15
        echo "        ";
        // line 16
        echo "        ";
        // line 17
        echo "    ";
        // line 18
        echo "    ";
        // line 19
        echo "        ";
        // line 20
        echo "    ";
        // line 22
        echo "
<div class=\"container\">
    ";
        // line 24
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ($_errors_) {
            // line 25
            echo "        <div class=\"alert fade in alert-danger\">
            <button class=\"close\" data-dismiss=\"alert\">×</button>
            ";
            // line 27
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_errors_);
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 28
                echo "                ";
                if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                if (($_error_ == "dont_match")) {
                    echo "Введенный пароли не совпадают.<br>";
                }
                // line 29
                echo "                ";
                if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                if (($_error_ == "short_pass")) {
                    echo "Введенный пароль слишком короткий.<br>";
                }
                // line 30
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 31
            echo "        </div>
    ";
        }
        // line 33
        echo "    <form class=\"form-signin\" method=\"POST\" action=\"\">
        <h3 class=\"form-signin-heading\">Введите новый пароль, а потом введите его еще раз, чтобы наверняка запомнить.</h3>
        <input name=\"pass\" type=\"password\" class=\"form-control\" placeholder=\"Пароль\">
        <input name=\"pass2\" type=\"password\" class=\"form-control\" placeholder=\"Повторить пароль\">
        <input type=\"hidden\" name=\"code\" value=\"";
        // line 37
        if (isset($context["code"])) { $_code_ = $context["code"]; } else { $_code_ = null; }
        echo $_code_;
        echo "\" />
        <button type=\"submit\" name=\"step\" value=\"4\" class=\"btn btn-lg btn-primary btn-block\">Отправить</button>
        <div class=\"login-links\">
            <a href=\"";
        // line 40
        if (isset($context["auth"])) { $_auth_ = $context["auth"]; } else { $_auth_ = null; }
        echo $_auth_;
        echo "\">Я вспомнил пароль!</a>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "auth/views/recover/templates/step3.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 40,  99 => 37,  93 => 33,  89 => 31,  83 => 30,  77 => 29,  71 => 28,  66 => 27,  62 => 25,  59 => 24,  55 => 22,  53 => 20,  51 => 19,  49 => 18,  47 => 17,  45 => 16,  43 => 15,  41 => 14,  39 => 13,  37 => 12,  35 => 11,  33 => 10,  31 => 9,  29 => 8,  27 => 7,  25 => 6,  23 => 5,  21 => 4,  19 => 3,  17 => 2,);
    }
}
