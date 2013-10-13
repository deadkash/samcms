<?php

/* builder/views/config/templates/config.twig */
class __TwigTemplate_49639d2a3949b213ecdf44a796135325 extends Twig_Template
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
        .red { color: red; }
    </style>
    <script type=\"text/javascript\" src=\"/lib/jquery/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"/lib/bootstrap/js/bootstrap.js\"></script>
    <script type=\"text/javascript\" src=\"/lib/bootstrap/js/bootstrap-alert.js\"></script>
    <script type=\"text/javascript\">
        \$(document).ready(function(){
            \$('.alert').alert();
            \$('.close').click(function(){
                \$(this).parents('.alert').alert('close');
            });
        });
    </script>
</head>
<body>
<div class=\"container\">
    ";
        // line 28
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        echo $_messages_;
        echo "
    <div class=\"page-header\">
        <h1>";
        // line 30
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_config_step1");
        echo " <small>";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_config_step1_desc");
        echo "</small></h1>
    </div>
    <form class=\"form-horizontal\" action=\"/install/\" method=\"GET\">
        <fieldset>
            <legend>";
        // line 34
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_config_db");
        echo "</legend>
            ";
        // line 35
        if (isset($context["dbFields"])) { $_dbFields_ = $context["dbFields"]; } else { $_dbFields_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_dbFields_);
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 36
            echo "                <div class=\"control-group";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "error")) {
                echo " error";
            }
            echo "\">
                    <label class=\"control-label\" for=\"";
            // line 37
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "name");
            echo "\">";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "title");
            echo " ";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "required")) {
                echo "<span class=\"red\">*</span>";
            }
            echo "</label>
                    <div class=\"controls\">";
            // line 38
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "html");
            echo "</div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 41
        echo "        </fieldset>
        <fieldset>
            <legend>";
        // line 43
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_config_theme");
        echo "</legend>
            <div class=\"control-group\">
                <label class=\"control-label\" for=\"theme\">";
        // line 45
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_config_theme_site");
        echo "</label>
                <div class=\"controls\">
                    ";
        // line 47
        if (isset($context["siteThemes"])) { $_siteThemes_ = $context["siteThemes"]; } else { $_siteThemes_ = null; }
        if ($_siteThemes_) {
            // line 48
            echo "                    <select name=\"theme\" id=\"theme\">
                        ";
            // line 49
            if (isset($context["siteThemes"])) { $_siteThemes_ = $context["siteThemes"]; } else { $_siteThemes_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_siteThemes_);
            foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
                // line 50
                echo "                        <option value=\"";
                if (isset($context["theme"])) { $_theme_ = $context["theme"]; } else { $_theme_ = null; }
                echo $_theme_;
                echo "\">";
                if (isset($context["theme"])) { $_theme_ = $context["theme"]; } else { $_theme_ = null; }
                echo $_theme_;
                echo "</option>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 52
            echo "                    </select>
                    ";
        }
        // line 54
        echo "                </div>
            </div>
            <div class=\"control-group\">
                <label class=\"control-label\" for=\"admintheme\">";
        // line 57
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_config_theme_admin");
        echo "</label>
                <div class=\"controls\">
                    ";
        // line 59
        if (isset($context["adminThemes"])) { $_adminThemes_ = $context["adminThemes"]; } else { $_adminThemes_ = null; }
        if ($_adminThemes_) {
            // line 60
            echo "                    <select name=\"admintheme\" id=\"admintheme\">
                        ";
            // line 61
            if (isset($context["adminThemes"])) { $_adminThemes_ = $context["adminThemes"]; } else { $_adminThemes_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_adminThemes_);
            foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
                // line 62
                echo "                        <option value=\"";
                if (isset($context["theme"])) { $_theme_ = $context["theme"]; } else { $_theme_ = null; }
                echo $_theme_;
                echo "\">";
                if (isset($context["theme"])) { $_theme_ = $context["theme"]; } else { $_theme_ = null; }
                echo $_theme_;
                echo "</option>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 64
            echo "                    </select>
                    ";
        }
        // line 66
        echo "                </div>
            </div>
        </fieldset>
        <div class=\"control-group\">
            <div class=\"controls\">
                <a href=\"/install/\" class=\"btn\">";
        // line 71
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_config_back");
        echo "</a>
                <input type=\"hidden\" name=\"task\" value=\"setConfig\" />
                <button type=\"submit\" name=\"view\" value=\"config\" class=\"btn btn-info\">";
        // line 73
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_config_continue");
        echo "</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "builder/views/config/templates/config.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  204 => 73,  198 => 71,  191 => 66,  187 => 64,  174 => 62,  169 => 61,  166 => 60,  163 => 59,  157 => 57,  152 => 54,  148 => 52,  135 => 50,  130 => 49,  127 => 48,  124 => 47,  118 => 45,  112 => 43,  108 => 41,  98 => 38,  85 => 37,  77 => 36,  72 => 35,  67 => 34,  56 => 30,  50 => 28,  24 => 6,  17 => 1,);
    }
}
