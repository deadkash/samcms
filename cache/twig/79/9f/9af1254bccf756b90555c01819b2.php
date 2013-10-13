<?php

/* modules/views/add/templates/add.twig */
class __TwigTemplate_799f9af1254bccf756b90555c01819b2 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "modules_new_module");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\" role=\"form\">
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\">";
        // line 5
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_module");
        echo "</label>
            <div class=\"col-lg-6\">
                <span class=\"form-control uneditable-input\">";
        // line 7
        if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
        echo $this->getAttribute($_module_, "title");
        echo "</span>
            </div>
        </div>
        <div class=\"form-group";
        // line 10
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "empty_title")) {
            echo " has-error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"title\">";
        // line 11
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_title");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"text\" class=\"form-control\" id=\"title\" name=\"title\" value=\"";
        // line 13
        if (isset($context["title"])) { $_title_ = $context["title"]; } else { $_title_ = null; }
        echo $_title_;
        echo "\">
            </div>
        </div>
        <div class=\"form-group";
        // line 16
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "empty_label")) {
            echo " has-error";
        }
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "label_exists")) {
            echo " error";
        }
        echo "\">
            <label class=\"col-lg-2 control-label\" for=\"label\">";
        // line 17
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_label");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"text\" class=\"form-control\" id=\"label\" name=\"label\" value=\"";
        // line 19
        if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
        echo $_label_;
        echo "\">
            </div>
        </div>
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\" for=\"active\">";
        // line 23
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_active");
        echo "</label>
            <div class=\"col-lg-6\">
                <input type=\"checkbox\" id=\"active\" name=\"active\" value=\"1\" checked=\"checked\" />
            </div>
        </div>
        ";
        // line 28
        if (isset($context["moduleParameters"])) { $_moduleParameters_ = $context["moduleParameters"]; } else { $_moduleParameters_ = null; }
        if ($_moduleParameters_) {
            // line 29
            echo "        <h3 class=\"page-header\">";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "modules_module_params");
            echo "</h3>
        ";
            // line 30
            if (isset($context["moduleParameters"])) { $_moduleParameters_ = $context["moduleParameters"]; } else { $_moduleParameters_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_moduleParameters_);
            foreach ($context['_seq'] as $context["_key"] => $context["param"]) {
                // line 31
                echo "        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\" for=\"";
                // line 32
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "name");
                echo "\">";
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "title");
                echo "</label>
            <div class=\"col-lg-10\">";
                // line 33
                if (isset($context["param"])) { $_param_ = $context["param"]; } else { $_param_ = null; }
                echo $this->getAttribute($_param_, "html");
                echo "</div>
        </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['param'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 36
            echo "        ";
        }
        // line 37
        echo "        <div class=\"form-group\">
            <div class=\"col-lg-6\">
                <input type=\"hidden\" name=\"task\" value=\"save\" />
                <input type=\"hidden\" name=\"module\" value=\"";
        // line 40
        if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
        echo $this->getAttribute($_module_, "name");
        echo "\" />
                <button class=\"btn btn-default\" type=\"submit\">";
        // line 41
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_save");
        echo "</button>
                <a class=\"btn btn-default\" type=\"button\" href=\"";
        // line 42
        if (isset($context["back"])) { $_back_ = $context["back"]; } else { $_back_ = null; }
        echo $_back_;
        echo "\">";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_cancel");
        echo "</a>
            </div>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "modules/views/add/templates/add.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  151 => 42,  146 => 41,  141 => 40,  136 => 37,  133 => 36,  123 => 33,  115 => 32,  112 => 31,  107 => 30,  101 => 29,  98 => 28,  89 => 23,  81 => 19,  75 => 17,  64 => 16,  57 => 13,  51 => 11,  44 => 10,  37 => 7,  31 => 5,  25 => 3,  20 => 2,  17 => 1,);
    }
}
