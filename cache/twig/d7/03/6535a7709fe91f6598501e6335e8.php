<?php

/* builder/views/done/templates/done.twig */
class __TwigTemplate_d7036535a7709fe91f6598501e6335e8 extends Twig_Template
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
        echo "<!doctype html>
<html lang=\"ru-RU\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 6
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_title");
        echo "</title>
    <link rel=\"stylesheet\" href=\"/lib/bootstrap/css/bootstrap.css\"/>
    <link rel=\"stylesheet\" href=\"/lib/bootstrap/css/bootstrap-responsive.css\"/>
    <link rel=\"stylesheet\" href=\"/install/components/builder/assets/css/main.css\"/>
    <style type=\"text/css\">
        body { padding-top: 40px; }
    </style>
</head>
<body>
<div class=\"container\">
    <div class=\"hero-unit text-center\">
        <h1>";
        // line 17
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_done_congratulations");
        echo "</h1>
        <p>";
        // line 18
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_done_finish");
        echo "</p>
    </div>
    <div class=\"text-center\">
        <a class=\"btn btn-large btn-success\" href=\"/\">";
        // line 21
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_done_site");
        echo "</a>
        <a class=\"btn btn-large btn-success\" href=\"/admin/\">";
        // line 22
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_done_admin");
        echo "</a>
    </div>
</div>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "builder/views/done/templates/done.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 22,  51 => 21,  44 => 18,  39 => 17,  24 => 6,  17 => 1,);
    }
}
