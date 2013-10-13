<?php

/* menueditor/views/edit/templates/edit.twig */
class __TwigTemplate_891d4fc4482b189e8a9a0554aec8b3e0 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "menueditor_editmenu");
        echo " <small>";
        if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
        echo $this->getAttribute($_menu_, "title");
        echo "</small></h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\">
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\" for=\"title\">ID</label>
            <div class=\"col-lg-4\">
                <span class=\"form-control uneditable-input\">";
        // line 7
        if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
        echo $this->getAttribute($_menu_, "id");
        echo "</span>
            </div>
        </div>
        <div class=\"form-group";
        // line 10
        if (isset($context["menu_empty_title"])) { $_menu_empty_title_ = $context["menu_empty_title"]; } else { $_menu_empty_title_ = null; }
        if ($_menu_empty_title_) {
            echo " error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"title\">";
        // line 11
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_title");
        echo "</label>
            <div class=\"col-lg-4\">
                <input type=\"text\" class=\"form-control\" id=\"title\" name=\"title\" value=\"";
        // line 13
        if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
        echo $this->getAttribute($_menu_, "title");
        echo "\">
            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"controls\">
                <input type=\"hidden\" name=\"menu_id\" value=\"";
        // line 18
        if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
        echo $this->getAttribute($_menu_, "id");
        echo "\">
                <input type=\"hidden\" name=\"task\" value=\"save\" />
                <button class=\"btn btn-default\" type=\"submit\">";
        // line 20
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_save");
        echo "</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 21
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
        return "menueditor/views/edit/templates/edit.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 21,  71 => 20,  65 => 18,  56 => 13,  50 => 11,  43 => 10,  36 => 7,  28 => 3,  20 => 2,  17 => 1,);
    }
}
