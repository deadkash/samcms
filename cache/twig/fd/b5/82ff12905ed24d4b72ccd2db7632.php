<?php

/* auth/views/login/templates/login.twig */
class __TwigTemplate_fdb582ff12905ed24d4b72ccd2db7632 extends Twig_Template
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
        if (isset($context["result"])) { $_result_ = $context["result"]; } else { $_result_ = null; }
        if ($_result_) {
            // line 3
            echo "        ";
            if (isset($context["result"])) { $_result_ = $context["result"]; } else { $_result_ = null; }
            if (($_result_ == "error")) {
                // line 4
                echo "            <div class=\"alert fade in alert-danger\">
                <button class=\"close\" data-dismiss=\"alert\">×</button>
                ";
                // line 6
                if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
                echo $this->getAttribute($_ln_, "auth_invalid");
                echo "
            </div>
        ";
            }
            // line 9
            echo "    ";
        }
        // line 10
        echo "    <form class=\"form-signin\" method=\"POST\" action=\"\">
        <h2 class=\"form-signin-heading\">";
        // line 11
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "auth");
        echo "</h2>
        <input name=\"login\" type=\"text\" class=\"form-control\" placeholder=\"";
        // line 12
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "auth_login");
        echo "\" autofocus>
        <input type=\"password\" class=\"form-control\" placeholder=\"";
        // line 13
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "auth_password");
        echo "\" name=\"password\" >
        <button class=\"btn btn-lg btn-primary btn-block\" name=\"action\" value=\"login\" type=\"submit\">";
        // line 14
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "auth_enter");
        echo "</button>
        <div>
            <a href=\"";
        // line 16
        if (isset($context["recover"])) { $_recover_ = $context["recover"]; } else { $_recover_ = null; }
        echo $_recover_;
        echo "\">";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "auth_recover");
        echo "</a>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "auth/views/login/templates/login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 16,  59 => 14,  54 => 13,  49 => 12,  44 => 11,  41 => 10,  38 => 9,  31 => 6,  27 => 4,  23 => 3,  20 => 2,  17 => 1,);
    }
}
