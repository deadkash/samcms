<?php

/* forms/views/edit/templates/edit_form.twig */
class __TwigTemplate_bae337b8744766b9b695b7626ad0c87c extends Twig_Template
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
        echo $this->getAttribute($_ln_, "forms_edit_form");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\" role=\"form\">
        <div class=\"form-group\">
            <label class=\"col-lg-2 control-label\">ID</label>
            <div class=\"col-lg-10\">
                <span class=\"form-control uneditable-input\">";
        // line 7
        if (isset($context["form_id"])) { $_form_id_ = $context["form_id"]; } else { $_form_id_ = null; }
        echo $_form_id_;
        echo "</span>
            </div>
        </div>
        ";
        // line 10
        if (isset($context["fields"])) { $_fields_ = $context["fields"]; } else { $_fields_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_fields_);
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 11
            echo "            <div class=\"form-group";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "error")) {
                echo " has-error";
            }
            echo "\">
                <label class=\"col-lg-2 control-label\" for=\"";
            // line 12
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "name");
            echo "\"><strong>";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "title");
            echo "</strong> ";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "required")) {
                echo "<span class=\"red\">*</span>";
            }
            echo "</label>
                <div class=\"col-lg-10\">";
            // line 13
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "html");
            echo "</div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 16
        echo "        <div class=\"form-group\">
            <div class=\"col-lg-10\">
                <input type=\"hidden\" name=\"task\" value=\"update\" />
                <input type=\"hidden\" name=\"form_id\" value=\"";
        // line 19
        if (isset($context["form_id"])) { $_form_id_ = $context["form_id"]; } else { $_form_id_ = null; }
        echo $_form_id_;
        echo "\"/>
                <button class=\"btn btn-default\" type=\"submit\">";
        // line 20
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "forms_save");
        echo "</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 21
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "forms_cancel");
        echo "</button>
            </div>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "forms/views/edit/templates/edit_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 21,  86 => 20,  81 => 19,  76 => 16,  66 => 13,  53 => 12,  45 => 11,  40 => 10,  33 => 7,  25 => 3,  20 => 2,  17 => 1,);
    }
}
