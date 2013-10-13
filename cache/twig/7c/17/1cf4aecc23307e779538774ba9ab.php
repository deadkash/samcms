<?php

/* forms/views/list/templates/fields.twig */
class __TwigTemplate_7c171cf4aecc23307e779538774ba9ab extends Twig_Template
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
        echo $this->getAttribute($_ln_, "forms_fields");
        echo " <small>";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->getAttribute($_form_, "title");
        echo "</small></h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" method=\"POST\">
        <div class=\"buttons\">
            <div class=\"btn-group\">
                <a href=\"";
        // line 6
        if (isset($context["back"])) { $_back_ = $context["back"]; } else { $_back_ = null; }
        echo $_back_;
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-chevron-left\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "forms_back");
        echo "</a>
                <a href=\"";
        // line 7
        if (isset($context["add"])) { $_add_ = $context["add"]; } else { $_add_ = null; }
        echo $_add_;
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "forms_add");
        echo "</a>
                <button name=\"task\" value=\"delete\" type=\"submit\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-trash\"></i>&nbsp;";
        // line 8
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "forms_delete");
        echo "</button>
            </div>
            <div style=\"clear: both;\"></div>
        </div>
        <div class=\"menus\">
            <table class=\"table table-striped\">
                <tr>
                    <th class=\"th30\"><input type=\"checkbox\" class=\"check-all\"></th>
                    <th class=\"th30\">ID</th>
                    <th>";
        // line 17
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "forms_name");
        echo "</th>
                    <th>";
        // line 18
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "forms_type");
        echo "</th>
                    <th>";
        // line 19
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "forms_field_required");
        echo "</th>
                    <th class=\"th80\"></th>
                    <th class=\"th100\"></th>
                </tr>
                ";
        // line 23
        if (isset($context["fields"])) { $_fields_ = $context["fields"]; } else { $_fields_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_fields_);
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 24
            echo "                    <tr>
                        <td><input type=\"checkbox\" class=\"check-item\" name=\"item[]\" value=\"";
            // line 25
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "id");
            echo "\"></td>
                        <td>";
            // line 26
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "id");
            echo "</td>
                        <td><a href=\"";
            // line 27
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "edit");
            echo "\">";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "title");
            echo "</a></td>
                        <td><span class=\"badge\">";
            // line 28
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "type");
            echo "</span></td>
                        <td>
                            ";
            // line 30
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "required")) {
                // line 31
                echo "                                <i class=\"glyphicon glyphicon-ok\"></i>
                            ";
            } else {
                // line 33
                echo "                                <i class=\"glyphicon glyphicon-remove\"></i>
                            ";
            }
            // line 35
            echo "                        </td>
                        <td class=\"btnset\">
                            <a href=\"";
            // line 37
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "edit");
            echo "\" title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "forms_edit");
            echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-pencil\"></i></a>
                        </td>
                        <td class=\"btnset\">
                            <div class=\"btn-group\">
                                <button name=\"moveup\" value=\"";
            // line 41
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "id");
            echo "\" class=\"btn btn-default ";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "disabledUp")) {
                echo "disabled";
            }
            echo "\" ";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "disabledUp")) {
                echo "disabled=\"disabled\"";
            }
            echo " title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "forms_up");
            echo "\"><i class=\"glyphicon glyphicon-chevron-up\"></i></button>
                                <button name=\"movedown\" value=\"";
            // line 42
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            echo $this->getAttribute($_field_, "id");
            echo "\" class=\"btn btn-default ";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "disabledDown")) {
                echo "disabled";
            }
            echo "\" ";
            if (isset($context["field"])) { $_field_ = $context["field"]; } else { $_field_ = null; }
            if ($this->getAttribute($_field_, "disabledDown")) {
                echo "disabled=\"disabled\"";
            }
            echo " title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "forms_down");
            echo "\"><i class=\"glyphicon glyphicon-chevron-down\"></i></button>
                            </div>
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 47
        echo "            </table>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "forms/views/list/templates/fields.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  183 => 47,  158 => 42,  140 => 41,  129 => 37,  125 => 35,  121 => 33,  117 => 31,  114 => 30,  108 => 28,  100 => 27,  95 => 26,  90 => 25,  87 => 24,  82 => 23,  74 => 19,  69 => 18,  64 => 17,  51 => 8,  43 => 7,  35 => 6,  28 => 3,  20 => 2,  17 => 1,);
    }
}
