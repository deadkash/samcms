<?php

/* index.twig */
class __TwigTemplate_0373f0934adb12518cda5f5d5463e152 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html>
<head>
    <title>";
        // line 4
        if (isset($context["documentTitle"])) { $_documentTitle_ = $context["documentTitle"]; } else { $_documentTitle_ = null; }
        echo $_documentTitle_;
        echo "</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"/lib/bootstrap3/css/bootstrap.min.css\"/>
    <link type=\"text/css\" rel=\"stylesheet\" href=\"/admin/templates/bootstrap3/css/main.css\" />
    ";
        // line 9
        if (isset($context["css"])) { $_css_ = $context["css"]; } else { $_css_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_css_);
        foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
            echo "<link rel=\"stylesheet\" href=\"";
            if (isset($context["c"])) { $_c_ = $context["c"]; } else { $_c_ = null; }
            echo $_c_;
            echo "\"/>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 10
        echo "    <script type=\"text/javascript\" src=\"/lib/jquery/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"/lib/bootstrap3/js/bootstrap.min.js\"></script>
    <script type=\"text/javascript\" src=\"/admin/templates/bootstrap3/js/popup-message.js\"></script>
    <script type=\"text/javascript\" src=\"/admin/templates/bootstrap3/js/list.js\"></script>
    ";
        // line 14
        if (isset($context["js"])) { $_js_ = $context["js"]; } else { $_js_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_js_);
        foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
            echo "<script type=\"text/javascript\" src=\"";
            if (isset($context["j"])) { $_j_ = $context["j"]; } else { $_j_ = null; }
            echo $_j_;
            echo "\"></script>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 15
        echo "</head>
<body>

<div class=\"container main\">
    <div class=\"navbar navbar-default\" role=\"navigation\">
        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-ex1-collapse\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            <a class=\"navbar-brand\" href=\"/admin/\">SamCMS 0.2.4</a>
        </div>
        <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
            ";
        // line 30
        if (isset($context["upmenu"])) { $_upmenu_ = $context["upmenu"]; } else { $_upmenu_ = null; }
        echo $_upmenu_;
        echo "
            ";
        // line 31
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo $_user_;
        echo "
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-2\">
            ";
        // line 36
        if (isset($context["leftmenu"])) { $_leftmenu_ = $context["leftmenu"]; } else { $_leftmenu_ = null; }
        echo $_leftmenu_;
        echo "
            ";
        // line 37
        if (isset($context["lefttext"])) { $_lefttext_ = $context["lefttext"]; } else { $_lefttext_ = null; }
        echo $_lefttext_;
        echo "
        </div>
        <div class=\"col-md-10\">
            ";
        // line 40
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        echo $_messages_;
        echo "
            ";
        // line 41
        if (isset($context["component"])) { $_component_ = $context["component"]; } else { $_component_ = null; }
        echo $_component_;
        echo "
        </div>
    </div>
    <div class=\"container\"></div>
</div>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 41,  106 => 40,  99 => 37,  94 => 36,  85 => 31,  80 => 30,  63 => 15,  50 => 14,  44 => 10,  31 => 9,  22 => 4,  17 => 1,);
    }
}
