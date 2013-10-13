<?php

/* menueditor/views/items/templates/items.twig */
class __TwigTemplate_4701811e5e3f7d98d56d74757ae0e0f1 extends Twig_Template
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
        echo $this->getAttribute($_ln_, "menueditor_items");
        echo " <small>";
        if (isset($context["menu"])) { $_menu_ = $context["menu"]; } else { $_menu_ = null; }
        echo $this->getAttribute($_menu_, "title");
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
        echo $this->getAttribute($_ln_, "menueditor_back");
        echo "</a>
                ";
        // line 7
        if (isset($context["types"])) { $_types_ = $context["types"]; } else { $_types_ = null; }
        if ($_types_) {
            // line 8
            echo "                <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_add");
            echo " <span class=\"caret\"></span></button>
                <ul class=\"dropdown-menu\">
                    ";
            // line 10
            if (isset($context["types"])) { $_types_ = $context["types"]; } else { $_types_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_types_);
            foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
                // line 11
                echo "                    <li><a href=\"";
                if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
                echo $this->getAttribute($_type_, "url");
                echo "\">";
                if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
                echo $this->getAttribute($_type_, "title");
                echo "</a></li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 13
            echo "                </ul>
                ";
        }
        // line 15
        echo "                <button name=\"task\" value=\"delete\" type=\"submit\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-trash\"></i>&nbsp;";
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
        // line 24
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_name");
        echo "</th>
                    <th>";
        // line 25
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_component");
        echo "</th>
                    <th>";
        // line 26
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_alias");
        echo "</th>
                    <th>";
        // line 27
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_active");
        echo "</th>
                    <th>";
        // line 28
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "menueditor_visible");
        echo "</th>
                    <th class=\"th80\"></th>
                    <th class=\"th100\"></th>
                </tr>
                ";
        // line 32
        if (isset($context["items"])) { $_items_ = $context["items"]; } else { $_items_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_items_);
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 33
            echo "                <tr>
                    <td><input type=\"checkbox\" class=\"check-item\" name=\"item[]\" value=\"";
            // line 34
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "id");
            echo "\"></td>
                    <td>";
            // line 35
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "id");
            echo "</td>
                    <td><a href=\"";
            // line 36
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "edit");
            echo "\">";
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "title");
            echo "</a></td>
                    <td>
                        ";
            // line 38
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            if ($this->getAttribute($_item_, "component_title")) {
                // line 39
                echo "                        <span class=\"label label-info\">";
                if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                echo $this->getAttribute($_item_, "component_title");
                echo "</span>
                        ";
            }
            // line 41
            echo "                    </td>
                    <td>";
            // line 42
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "alias");
            echo "</td>
                    <td>
                        ";
            // line 44
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            if ($this->getAttribute($_item_, "active")) {
                // line 45
                echo "                        <i class=\"glyphicon glyphicon-ok\"></i>
                        ";
            } else {
                // line 47
                echo "                        <i class=\"glyphicon glyphicon-remove\"></i>
                        ";
            }
            // line 49
            echo "                    </td>
                    <td>
                        ";
            // line 51
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            if ($this->getAttribute($_item_, "visible")) {
                // line 52
                echo "                        <i class=\"glyphicon glyphicon-ok\"></i>
                        ";
            } else {
                // line 54
                echo "                        <i class=\"glyphicon glyphicon-remove\"></i>
                        ";
            }
            // line 56
            echo "                    </td>
                    <td class=\"btnset\">
                        <a href=\"";
            // line 58
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "edit");
            echo "\" title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_edit");
            echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-pencil\"></i></a>
                    </td>
                    <td class=\"btnset\">
                        <div class=\"btn-group\">
                            <button name=\"moveup\" value=\"";
            // line 62
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "id");
            echo "\" class=\"btn btn-default ";
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            if ($this->getAttribute($_item_, "disabledUp")) {
                echo "disabled";
            }
            echo "\" ";
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            if ($this->getAttribute($_item_, "disabledUp")) {
                echo "disabled=\"disabled\"";
            }
            echo " title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_up");
            echo "\"><i class=\"glyphicon glyphicon-chevron-up\"></i></button>
                            <button name=\"movedown\" value=\"";
            // line 63
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            echo $this->getAttribute($_item_, "id");
            echo "\" class=\"btn btn-default ";
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            if ($this->getAttribute($_item_, "disabledDown")) {
                echo "disabled";
            }
            echo "\" ";
            if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
            if ($this->getAttribute($_item_, "disabledDown")) {
                echo "disabled=\"disabled\"";
            }
            echo " title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "menueditor_down");
            echo "\"><i class=\"glyphicon glyphicon-chevron-down\"></i></button>
                        </div>
                    </td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 68
        echo "            </table>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "menueditor/views/items/templates/items.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  247 => 68,  222 => 63,  204 => 62,  193 => 58,  189 => 56,  185 => 54,  181 => 52,  178 => 51,  174 => 49,  170 => 47,  166 => 45,  163 => 44,  157 => 42,  154 => 41,  147 => 39,  144 => 38,  135 => 36,  130 => 35,  125 => 34,  122 => 33,  117 => 32,  109 => 28,  104 => 27,  99 => 26,  94 => 25,  89 => 24,  75 => 15,  71 => 13,  58 => 11,  53 => 10,  46 => 8,  43 => 7,  35 => 6,  28 => 3,  20 => 2,  17 => 1,);
    }
}
