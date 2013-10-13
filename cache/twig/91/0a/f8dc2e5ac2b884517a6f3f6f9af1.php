<?php

/* builder/views/welcome/templates/welcome.twig */
class __TwigTemplate_910af8dc2e5ac2b884517a6f3f6f9af1 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "install_welcome");
        echo "</h1>
            <p>";
        // line 18
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_welcome_subtext");
        echo "</p>

        </div>
        <form action=\"/install/\" method=\"GET\">
            <div class=\"row\">
                <div class=\"span5 offset2\">
                    <p>";
        // line 24
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_welcome_description1");
        echo "</p>
                    <p>";
        // line 25
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_welcome_description2");
        echo "</p>
                </div>
                ";
        // line 27
        if (isset($context["languages"])) { $_languages_ = $context["languages"]; } else { $_languages_ = null; }
        if ($_languages_) {
            // line 28
            echo "                <div class=\"span5\">
                    <p>
                        <label for=\"language\">";
            // line 30
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "install_welcome_select_language");
            echo ":</label>
                        <select name=\"language\" id=\"language\" multiple>
                            ";
            // line 32
            if (isset($context["languages"])) { $_languages_ = $context["languages"]; } else { $_languages_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_languages_);
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 33
                echo "                            <option value=\"";
                if (isset($context["language"])) { $_language_ = $context["language"]; } else { $_language_ = null; }
                echo $this->getAttribute($_language_, "value");
                echo "\" ";
                if (isset($context["language"])) { $_language_ = $context["language"]; } else { $_language_ = null; }
                if ($this->getAttribute($_language_, "selected")) {
                    echo "selected=\"selected\"";
                }
                echo ">";
                if (isset($context["language"])) { $_language_ = $context["language"]; } else { $_language_ = null; }
                echo $this->getAttribute($_language_, "title");
                echo "</option>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 35
            echo "                        </select>
                    </p>
                </div>
                ";
        }
        // line 39
        echo "            </div>
            <div class=\"row text-center\">
                <input type=\"hidden\" name=\"view\" value=\"config\" />
                <input type=\"hidden\" name=\"task\" value=\"setLanguage\" />
                <p><button class=\"btn btn-large btn-primary\">";
        // line 43
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_welcome_continue");
        echo "</button></p>
            </div>
        </form>
    </div>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "builder/views/welcome/templates/welcome.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 43,  107 => 39,  101 => 35,  83 => 33,  78 => 32,  72 => 30,  68 => 28,  65 => 27,  59 => 25,  54 => 24,  44 => 18,  39 => 17,  24 => 6,  17 => 1,);
    }
}
