<?php

/* builder/views/user/templates/user.twig */
class __TwigTemplate_34ce40c8e2b5749a5a9a72a282676b7a extends Twig_Template
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
</head>
<body>
<div class=\"container\">
    ";
        // line 17
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        echo $_messages_;
        echo "
    <div class=\"page-header\">
        <h1>";
        // line 19
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_user_step2");
        echo " <small>";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_user_step2_desc");
        echo "</small></h1>
    </div>
    <form class=\"form-horizontal\" action=\"/install/\" method=\"GET\">
        <div class=\"control-group\">
            ";
        // line 23
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_user_description");
        echo "
        </div>
        ";
        // line 25
        if (isset($context["fields"])) { $_fields_ = $context["fields"]; } else { $_fields_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_fields_);
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 26
            echo "            <div class=\"control-group";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "error")) {
                echo " error";
            }
            echo "\">
                <label class=\"control-label\" for=\"";
            // line 27
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
                <div class=\"controls\">
                    ";
            // line 29
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "html");
            echo "
                    <p class=\"muted\"><small>";
            // line 30
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "description");
            echo "</small></p>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 34
        echo "        <div class=\"control-group\">
            <div class=\"controls\">
                <input type=\"hidden\" name=\"task\" value=\"setUser\" />
                <button type=\"submit\" name=\"view\" value=\"user\" class=\"btn btn-info\">";
        // line 37
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "install_user_continue");
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
        return "builder/views/user/templates/user.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 37,  105 => 34,  94 => 30,  89 => 29,  75 => 27,  67 => 26,  62 => 25,  56 => 23,  45 => 19,  39 => 17,  24 => 6,  17 => 1,);
    }
}
