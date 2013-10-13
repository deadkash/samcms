<?php

/* menueditor/views/add/templates/add.twig */
class __TwigTemplate_6f5a388767c494b81c09528ea929d31e extends Twig_Template
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
        echo "<div class=\"menu-add\">
    <h1>";
        // line 2
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_new_menu");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\" role=\"form\">
        <div class=\"form-group";
        // line 4
        if (isset($context["menu_empty_title"])) { $_menu_empty_title_ = $context["menu_empty_title"]; } else { $_menu_empty_title_ = null; }
        if ($_menu_empty_title_) {
            echo " error";
        }
        echo "\">
            <label for=\"title\" class=\"col-lg-2 control-label\">";
        // line 5
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_title");
        echo "</label>
            <div class=\"col-lg-4\">
                <input type=\"text\" class=\"form-control\" id=\"title\" name=\"title\" value=\"\">
            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-lg-4\">
                <input type=\"hidden\" name=\"task\" value=\"save\" />
                <button class=\"btn btn-default\" type=\"submit\">";
        // line 13
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_save");
        echo "</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 14
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_cancel");
        echo "</button>
            </div>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "menueditor/views/add/templates/add.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 14,  49 => 13,  37 => 5,  30 => 4,  25 => 3,  20 => 2,  17 => 1,);
    }
}
