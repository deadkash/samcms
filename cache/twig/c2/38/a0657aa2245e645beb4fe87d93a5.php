<?php

/* gallery/views/add/templates/add_size.twig */
class __TwigTemplate_c238a0657aa2245e645beb4fe87d93a5 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "gallery_new_size");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" class=\"form-horizontal\" method=\"POST\">
        ";
        // line 4
        if (isset($context["fields"])) { $_fields_ = $context["fields"]; } else { $_fields_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_fields_);
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 5
            echo "            <div class=\"form-group";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "error")) {
                echo " has-error";
            }
            echo "\">
                <label class=\"col-lg-2 control-label\" for=\"";
            // line 6
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
            // line 7
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "html");
            echo "</div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 10
        echo "        <div class=\"form-group\">
            <div class=\"col-lg-10\">
                <input type=\"hidden\" name=\"task\" value=\"save\" />
                <input type=\"hidden\" name=\"session_id\" value=\"";
        // line 13
        if (isset($context["session_id"])) { $_session_id_ = $context["session_id"]; } else { $_session_id_ = null; }
        echo $_session_id_;
        echo "\" />
                <button class=\"btn btn-default\" type=\"submit\">";
        // line 14
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_save");
        echo "</button>
                <button class=\"btn btn-default\" type=\"button\" onclick=\"history.back();\">";
        // line 15
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "gallery_cancel");
        echo "</button>
            </div>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "gallery/views/add/templates/add_size.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 15,  76 => 14,  71 => 13,  66 => 10,  56 => 7,  43 => 6,  35 => 5,  30 => 4,  25 => 3,  20 => 2,  17 => 1,);
    }
}
