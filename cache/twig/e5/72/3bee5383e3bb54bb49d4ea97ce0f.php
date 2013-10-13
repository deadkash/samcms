<?php

/* modules/views/edit/templates/edit.twig */
class __TwigTemplate_e5723bee5383e3bb54bb49d4ea97ce0f extends Twig_Template
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
        echo $this->getAttribute($_ln_, "modules_edit_module");
        echo " <small>";
        if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
        echo $this->getAttribute($_module_, "title");
        echo "</small></h1>
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
        echo $this->getAttribute($_module_, "module");
        echo "</span>
            </div>
        </div>
        <div class=\"form-group";
        // line 10
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "empty_title")) {
            echo " error";
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
        if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
        echo $this->getAttribute($_module_, "title");
        echo "\">
            </div>
        </div>
        <div class=\"form-group";
        // line 16
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($this->getAttribute($_messages_, "empty_label")) {
            echo " error";
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
        if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
        echo $this->getAttribute($_module_, "label");
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
                <input type=\"checkbox\" id=\"active\" name=\"active\" value=\"1\" ";
        // line 25
        if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
        if ($this->getAttribute($_module_, "active")) {
            echo "checked=\"checked\"";
        }
        echo " />
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
                <input type=\"hidden\" name=\"task\" value=\"edit\" />
                <input type=\"hidden\" name=\"module_id\" value=\"";
        // line 40
        if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
        echo $this->getAttribute($_module_, "id");
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
        return "modules/views/edit/templates/edit.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 42,  155 => 41,  150 => 40,  145 => 37,  142 => 36,  132 => 33,  124 => 32,  121 => 31,  116 => 30,  110 => 29,  107 => 28,  98 => 25,  92 => 23,  84 => 19,  78 => 17,  67 => 16,  60 => 13,  54 => 11,  47 => 10,  40 => 7,  34 => 5,  28 => 3,  20 => 2,  17 => 1,);
    }
}
