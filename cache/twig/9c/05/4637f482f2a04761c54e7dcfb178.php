<?php

/* index.twig */
class __TwigTemplate_9c054637f482f2a04761c54e7dcfb178 extends Twig_Template
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
        echo "<!DOCTYPE HTML>
<html>
<head>
    <title>";
        // line 4
        if (isset($context["documentTitle"])) { $_documentTitle_ = $context["documentTitle"]; } else { $_documentTitle_ = null; }
        echo $_documentTitle_;
        echo "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"";
        // line 6
        if (isset($context["documentDescription"])) { $_documentDescription_ = $context["documentDescription"]; } else { $_documentDescription_ = null; }
        echo $_documentDescription_;
        echo "\">
    <meta name=\"keywords\" content=\"";
        // line 7
        if (isset($context["documentKeywords"])) { $_documentKeywords_ = $context["documentKeywords"]; } else { $_documentKeywords_ = null; }
        echo $_documentKeywords_;
        echo "\">
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <link type=\"text/css\" rel=\"stylesheet\" href=\"/lib/bootstrap/css/bootstrap.css\" />
    <link type=\"text/css\" rel=\"stylesheet\" href=\"/lib/bootstrap/css/bootstrap-responsive.css\" />
    <link type=\"text/css\" rel=\"stylesheet\" href=\"/templates/default/css/main.css\" />
    ";
        // line 12
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
        // line 13
        echo "    <script type=\"text/javascript\" src=\"/lib/jquery/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"/lib/bootstrap/js/bootstrap.js\"></script>
    <script type=\"text/javascript\" src=\"/lib/bootstrap/js/bootstrap-alert.js\"></script>
    <script type=\"text/javascript\" src=\"/lib/bootstrap/js/bootstrap-tab.js\"></script>
    <script type=\"text/javascript\" src=\"/lib/bootstrap/js/bootstrap-modal.js\"></script>
    <script type=\"text/javascript\" src=\"/admin/templates/default/js/popup-message.js\"></script>
    <script type=\"text/javascript\" src=\"/admin/templates/default/js/list.js\"></script>
    ";
        // line 20
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
        // line 21
        echo "</head>
<body>
<div class=\"container\">
    <div class=\"row\">
        <div class=\"container\">
            ";
        // line 26
        if (isset($context["upmenu"])) { $_upmenu_ = $context["upmenu"]; } else { $_upmenu_ = null; }
        echo $_upmenu_;
        echo "
        </div>
        ";
        // line 28
        if (isset($context["slider"])) { $_slider_ = $context["slider"]; } else { $_slider_ = null; }
        echo $_slider_;
        echo "
        <div class=\"span12\">";
        // line 29
        if (isset($context["title"])) { $_title_ = $context["title"]; } else { $_title_ = null; }
        echo $_title_;
        echo "</div>
        <div class=\"span3\">
            ";
        // line 31
        if (isset($context["rightmenu"])) { $_rightmenu_ = $context["rightmenu"]; } else { $_rightmenu_ = null; }
        echo $_rightmenu_;
        echo "
            ";
        // line 32
        if (isset($context["search"])) { $_search_ = $context["search"]; } else { $_search_ = null; }
        echo $_search_;
        echo "
        </div>
        <div class=\"span6\">
            ";
        // line 35
        if (isset($context["pathline"])) { $_pathline_ = $context["pathline"]; } else { $_pathline_ = null; }
        echo $_pathline_;
        echo "
            ";
        // line 36
        if (isset($context["component"])) { $_component_ = $context["component"]; } else { $_component_ = null; }
        echo $_component_;
        echo "
            ";
        // line 37
        if (isset($context["social"])) { $_social_ = $context["social"]; } else { $_social_ = null; }
        echo $_social_;
        echo "
        </div>
        <div class=\"span3\">
            ";
        // line 40
        if (isset($context["right"])) { $_right_ = $context["right"]; } else { $_right_ = null; }
        echo $_right_;
        echo "
        </div>
    </div>
</body>
</html>";
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
        return array (  130 => 40,  123 => 37,  118 => 36,  113 => 35,  106 => 32,  101 => 31,  95 => 29,  90 => 28,  84 => 26,  77 => 21,  64 => 20,  55 => 13,  42 => 12,  33 => 7,  28 => 6,  22 => 4,  17 => 1,);
    }
}
