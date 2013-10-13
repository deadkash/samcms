<?php

/* users/views/add/templates/add_group.twig */
class __TwigTemplate_3fc06fdb4d9258b143f83b2f30122001 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "users_new_group");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\">
        <div class=\"form-group";
        // line 4
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "group_add")) {
            echo " error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"name\">";
        // line 5
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_title");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" value=\"\">
            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-lg-6\">
                <input type=\"hidden\" name=\"task\" value=\"save\" />
                <button class=\"btn btn-default\" type=\"submit\">";
        // line 13
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_save");
        echo "</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 14
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "users_cancel");
        echo "</button>
            </div>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "users/views/add/templates/add_group.twig";
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
