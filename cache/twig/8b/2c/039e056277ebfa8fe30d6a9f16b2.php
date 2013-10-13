<?php

/* menueditor/views/list/templates/list.twig */
class __TwigTemplate_8b2c039e056277ebfa8fe30d6a9f16b2 extends Twig_Template
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
        echo "<div>
    <h1>";
        // line 2
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_menulist");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" method=\"POST\">
        <div class=\"buttons\">
            <div class=\"btn-group\">
                <a href=\"";
        // line 6
        if (isset($context["add"])) { $_add_ = $context["add"]; } else { $_add_ = null; }
        echo $_add_;
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_add");
        echo "</a>
                <button name=\"task\" value=\"delete\" type=\"submit\" class=\"btn btn-default delete-btn\"><i class=\"glyphicon glyphicon-trash\"></i>&nbsp;";
        // line 7
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_delete");
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
        // line 16
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_name");
        echo "</th>
                    <th class=\"th100\"></th>
                </tr>
                ";
        // line 19
        if (isset($context["items"])) { $_items_ = $context["items"]; } else { $_items_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_items_);
        foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
            // line 20
            echo "                <tr>
                    <td><input type=\"checkbox\" class=\"check-item\" name=\"item[]\" value=\"";
            // line 21
            if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
            echo $this->getAttribute($_menu_, "id");
            echo "\"></td>
                    <td>";
            // line 22
            if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
            echo $this->getAttribute($_menu_, "id");
            echo "</td>
                    <td><a href=\"";
            // line 23
            if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
            echo $this->getAttribute($_menu_, "items");
            echo "\">";
            if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
            echo $this->getAttribute($_menu_, "title");
            echo "</a></td>
                    <td class=\"btnset\">
                        <div class=\"btn-group\">
                            <a href=\"";
            // line 26
            if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
            echo $this->getAttribute($_menu_, "edit");
            echo "\" title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_edit");
            echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-edit\"></i></a>
                            <a href=\"";
            // line 27
            if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
            echo $this->getAttribute($_menu_, "items");
            echo "\" title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_items");
            echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-list\"></i></a>
                        </div>
                    </td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 32
        echo "            </table>
        </div>
    </form>
</div>

";
    }

    public function getTemplateName()
    {
        return "menueditor/views/list/templates/list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 32,  96 => 27,  88 => 26,  78 => 23,  73 => 22,  68 => 21,  65 => 20,  60 => 19,  53 => 16,  40 => 7,  32 => 6,  25 => 3,  20 => 2,  17 => 1,);
    }
}
