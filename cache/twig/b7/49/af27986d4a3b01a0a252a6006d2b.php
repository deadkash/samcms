<?php

/* modules/views/list/templates/list.twig */
class __TwigTemplate_b749af27986d4a3b01a0a252a6006d2b extends Twig_Template
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
        echo $this->getAttribute($_ln_, "modules_modules");
        echo "</h1>
    <form action=\"";
        // line 3
        if (isset($context["url"])) { $_url_ = $context["url"]; } else { $_url_ = null; }
        echo $_url_;
        echo "\" method=\"POST\">
        <div class=\"buttons\">
            <div class=\"btn-group\">
                ";
        // line 6
        if (isset($context["types"])) { $_types_ = $context["types"]; } else { $_types_ = null; }
        if ($_types_) {
            // line 7
            echo "                <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"glyphicon glyphicon-plus\"></i>&nbsp;";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "modules_add");
            echo " <span class=\"caret\"></span></button>
                <ul class=\"dropdown-menu\">
                    ";
            // line 9
            if (isset($context["types"])) { $_types_ = $context["types"]; } else { $_types_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_types_);
            foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
                // line 10
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
            // line 12
            echo "                </ul>
                ";
        }
        // line 14
        echo "                <button name=\"task\" value=\"delete\" type=\"submit\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-trash\"></i>&nbsp;";
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_delete");
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
        // line 23
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_name");
        echo "</th>
                    <th>";
        // line 24
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_module");
        echo "</th>
                    <th>";
        // line 25
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_label");
        echo "</th>
                    <th>";
        // line 26
        if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
        echo $this->getAttribute($_ln_, "modules_active");
        echo "</th>
                    <th class=\"th100\"></th>
                </tr>
                ";
        // line 29
        if (isset($context["modules"])) { $_modules_ = $context["modules"]; } else { $_modules_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_modules_);
        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
            // line 30
            echo "                <tr>
                    <td><input type=\"checkbox\" class=\"check-item\" name=\"item[]\" value=\"";
            // line 31
            if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
            echo $this->getAttribute($_module_, "id");
            echo "\"></td>
                    <td>";
            // line 32
            if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
            echo $this->getAttribute($_module_, "id");
            echo "</td>
                    <td><a href=\"";
            // line 33
            if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
            echo $this->getAttribute($_module_, "edit");
            echo "\">";
            if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
            echo $this->getAttribute($_module_, "title");
            echo "</a></td>
                    <td>";
            // line 34
            if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
            echo $this->getAttribute($_module_, "module");
            echo "</td>
                    <td><span class=\"badge\">";
            // line 35
            if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
            echo $this->getAttribute($_module_, "label");
            echo "</span></td>
                    <td>
                        ";
            // line 37
            if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
            if ($this->getAttribute($_module_, "active")) {
                // line 38
                echo "                        <i class=\"glyphicon glyphicon-ok\"></i>
                        ";
            } else {
                // line 40
                echo "                        <i class=\"glyphicon glyphicon-remove\"></i>
                        ";
            }
            // line 42
            echo "                    <td class=\"btnset\">
                        <a href=\"";
            // line 43
            if (isset($context["module"])) { $_module_ = $context["module"]; } else { $_module_ = null; }
            echo $this->getAttribute($_module_, "edit");
            echo "\" title=\"";
            if (isset($context["ln"])) { $_ln_ = $context["ln"]; } else { $_ln_ = null; }
            echo $this->getAttribute($_ln_, "modulse_edit");
            echo "\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-edit\"></i></a>
                    </td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 47
        echo "            </table>
        </div>
        ";
        // line 49
        if (isset($context["pages"])) { $_pages_ = $context["pages"]; } else { $_pages_ = null; }
        if ($_pages_) {
            // line 50
            echo "            <div class=\"pagination pull-right\">
                <ul>
                    ";
            // line 52
            if (isset($context["pages"])) { $_pages_ = $context["pages"]; } else { $_pages_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_pages_);
            foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                // line 53
                echo "                        <li";
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                if ($this->getAttribute($_page_, "disabled")) {
                    echo " class=\"disabled\"";
                }
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                if ($this->getAttribute($_page_, "selected")) {
                    echo " class=\"active\"";
                }
                echo "><a href=\"";
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                echo $this->getAttribute($_page_, "href");
                echo "\">";
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                echo $this->getAttribute($_page_, "title");
                echo "</a></li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 55
            echo "                </ul>
            </div>
        ";
        }
        // line 58
        echo "    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "modules/views/list/templates/list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  208 => 58,  203 => 55,  181 => 53,  176 => 52,  172 => 50,  169 => 49,  165 => 47,  151 => 43,  148 => 42,  144 => 40,  140 => 38,  137 => 37,  131 => 35,  126 => 34,  118 => 33,  113 => 32,  108 => 31,  105 => 30,  100 => 29,  93 => 26,  88 => 25,  83 => 24,  78 => 23,  64 => 14,  60 => 12,  47 => 10,  42 => 9,  35 => 7,  32 => 6,  25 => 3,  20 => 2,  17 => 1,);
    }
}
